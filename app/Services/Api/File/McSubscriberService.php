<?php

namespace App\Services\Api\File;

use App\Repositories\Contracts\VideoRepository;
use App\Services\AbstractService;
use Aws\MediaConvert\MediaConvertClient; 
use Aws\Exception\AwsException;
use Storage;

class McSubscriberService extends AbstractService
{
    /**
     * @var VideoRepository
     */
    private $repository;
    
    /**
     * CreateService constructor.
     * @param FileRepository $repository
     */
    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * @param \Illuminate\Http\Request|\Illuminate\Support\Collection $request
     *
     * @return mixed
     *
     * @throws \Throwable
     */
    public function handle($request)
    {
        $payload = json_decode($request->getContent(), true) ?? [];

        // parse the params first
        try {
            if (empty($payload) || $payload['Type'] == 'SubscriptionConfirmation') {
                \Log::info($payload);
                return null;
            }
            $payloadMessage = json_decode($payload['Message'], true);
            $payloadDetail = $payloadMessage['detail'];
            $jobId = $payloadDetail['jobId'];
            $originKey = $payloadDetail['userMetadata']['originKey'];
            $outputKey = $payloadDetail['userMetadata']['outputKey'];
            
            $video = $this->repository->findByField('job_id', $jobId)->first();
            switch($payloadDetail['status']) {
                case "ERROR":
                    $video->processed = config('constants.video_convert_status.error');
                    $video->save();
                    break;
                case "COMPLETE":
                    // delete the base file to save storage cost
                    Storage::disk('s3')->delete($originKey);
                    // update status of video
                    $video->processed = config('constants.video_convert_status.complete');
                    $video->save();
                    break;
                default:
                    return null;
                    break;
            }
        } catch(Exception $ex) {
            \Log::info($ex->getMessage());
        }
    }
}