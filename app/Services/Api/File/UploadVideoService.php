<?php

namespace App\Services\Api\File;

use App\Repositories\Contracts\FileRepository;
use App\Services\AbstractService;
use Aws\S3\S3Client; 
use Aws\S3\MultipartUploader;
use Aws\Exception\MultipartUploadException;
use Aws\MediaConvert\MediaConvertClient; 
use Aws\Exception\AwsException;
use Storage;

class UploadVideoService extends AbstractService
{
    /**
     * @var ImageRepository
     */
    private $repository;

    /**
     * CreateService constructor.
     * @param FileRepository $repository
     */
    public function __construct(FileRepository $repository)
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
        $uploadedFile = $request->file('file');
        $extension = strtolower(pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_EXTENSION));
        $filePath = $uploadedFile->getRealPath();

        $fileName = generate_filename($extension);
        $directory = get_upload_folder($extension);
        $originKey = $directory . '/' . $fileName;
        $outputKey = $originKey;
        $jobId = null;
        $processed = config('constants.video_convert_status.init');

        // upload to s3
        $disk = Storage::disk('s3');
        $uploader = new MultipartUploader($disk->getDriver()->getAdapter()->getClient(), $filePath, [
            'bucket' => config('filesystems.disks.s3.bucket'),
            'key'    => $originKey,
        ]);

        try {
            $result = $uploader->upload();
            // call transcode, right now only for mov file
            if ($extension != config('constants.transcode_extension')) {
                $outputKey = str_replace($extension, config('constants.transcode_extension'), $outputKey);
                $mediaConvertClient = new MediaConvertClient([
                    'credentials' => [
                        'key'    => config('filesystems.disks.s3.key'),
                        'secret' => config('filesystems.disks.s3.secret')
                    ],
                    'version' => config('filesystems.disks.s3.mediaconvert.api_version'),
                    'region' => config('filesystems.disks.s3.region'),
                    'endpoint' => config('filesystems.disks.s3.mediaconvert.endpoint')
                ]);

                $fileInput = implode([
                    "s3://", 
                    config('filesystems.disks.s3.bucket'),
                    "/",
                    $originKey
                ]);
                $outputDestination = implode([
                    "s3://", 
                    config('filesystems.disks.s3.bucket'),
                    "/",
                    $directory,
                    "/"
                ]);
                $jobSetting = [
                    "TimecodeConfig" => [
                        "Source" => "ZEROBASED"
                    ],
                    "OutputGroups" => [
                        [
                            "CustomName" => "VideoConvert",
                            "Name" => "File Group",
                            "Outputs" => [
                                [
                                    "ContainerSettings" => [
                                        "Container" => "MP4",
                                        "Mp4Settings" => [
                                            "CslgAtom" => "INCLUDE",
                                            "FreeSpaceBox" => "EXCLUDE",
                                            "MoovPlacement" => "PROGRESSIVE_DOWNLOAD"
                                        ]
                                    ],
                                    "VideoDescription" => [
                                        "ScalingBehavior" => "DEFAULT",
                                        "TimecodeInsertion" => "DISABLED",
                                        "AntiAlias" => "ENABLED",
                                        "Sharpness" => 50,
                                        "CodecSettings" => [
                                            "Codec" => "H_264",
                                            "H264Settings" => [
                                            "InterlaceMode" => "PROGRESSIVE",
                                            "NumberReferenceFrames" => 3,
                                            "Syntax" => "DEFAULT",
                                            "Softness" => 0,
                                            "GopClosedCadence" => 1,
                                            "GopSize" => 90,
                                            "Slices" => 1,
                                            "GopBReference" => "DISABLED",
                                            "MaxBitrate" => 2000000,
                                            "SlowPal" => "DISABLED",
                                            "SpatialAdaptiveQuantization" => "ENABLED",
                                            "TemporalAdaptiveQuantization" => "ENABLED",
                                            "FlickerAdaptiveQuantization" => "DISABLED",
                                            "EntropyEncoding" => "CABAC",
                                            "FramerateControl" => "INITIALIZE_FROM_SOURCE",
                                            "RateControlMode" => "QVBR",
                                            "QvbrSettings" => [
                                                "QvbrQualityLevel" => 8
                                            ],
                                            "CodecProfile" => "MAIN",
                                            "Telecine" => "NONE",
                                            "MinIInterval" => 0,
                                            "AdaptiveQuantization" => "HIGH",
                                            "CodecLevel" => "AUTO",
                                            "FieldEncoding" => "PAFF",
                                            "SceneChangeDetect" => "ENABLED",
                                            "QualityTuningLevel" => "SINGLE_PASS_HQ",
                                            "FramerateConversionAlgorithm" => "DUPLICATE_DROP",
                                            "UnregisteredSeiTimecode" => "DISABLED",
                                            "GopSizeUnits" => "FRAMES",
                                            "ParControl" => "INITIALIZE_FROM_SOURCE",
                                            "NumberBFramesBetweenReferenceFrames" => 2,
                                            "RepeatPps" => "DISABLED",
                                            "DynamicSubGop" => "STATIC"
                                            ]
                                        ],
                                        "AfdSignaling" => "NONE",
                                        "DropFrameTimecode" => "ENABLED",
                                        "RespondToAfd" => "NONE",
                                        "ColorMetadata" => "INSERT"
                                    ],
                                    "AudioDescriptions" => [
                                        [
                                            "AudioTypeControl" => "FOLLOW_INPUT",
                                            "CodecSettings" => [
                                                "Codec" => "AAC",
                                                "AacSettings" => [
                                                    "AudioDescriptionBroadcasterMix" => "NORMAL",
                                                    "Bitrate" => 96000,
                                                    "RateControlMode" => "CBR",
                                                    "CodecProfile" => "LC",
                                                    "CodingMode" => "CODING_MODE_2_0",
                                                    "RawFormat" => "NONE",
                                                    "SampleRate" => 48000,
                                                    "Specification" => "MPEG4"
                                                ]
                                            ],
                                            "LanguageCodeControl" => "FOLLOW_INPUT"
                                        ]
                                    ],
                                    "Extension" => "mp4"
                                ]
                            ],
                            "OutputGroupSettings" => [
                                "Type" => "FILE_GROUP_SETTINGS",
                                "FileGroupSettings" => [
                                    "Destination" => $outputDestination
                                ]
                            ]
                        ]
                    ],
                    "AdAvailOffset" => 0,
                    "Inputs" => [
                        [
                            "AudioSelectors" => [
                                "Audio Selector 1" => [
                                    "Offset" => 0,
                                    "DefaultSelection" => "DEFAULT",
                                    "ProgramSelection" => 1
                                ]
                            ],
                            "VideoSelector" => [
                                "ColorSpace" => "FOLLOW",
                                "Rotate" => "DEGREE_0"
                            ],
                            "FilterEnable" => "AUTO",
                            "PsiControl" => "USE_PSI",
                            "FilterStrength" => 0,
                            "DeblockFilter" => "DISABLED",
                            "DenoiseFilter" => "DISABLED",
                            "TimecodeSource" => "ZEROBASED",
                            "FileInput" => $fileInput
                        ]
                    ]
                ];

                $result = $mediaConvertClient->createJob([
                    "Role" => config('filesystems.disks.s3.mediaconvert.mc_role'),
                    "Settings" => $jobSetting, //JobSettings structure
                    "Queue" => config('filesystems.disks.s3.mediaconvert.queue_arn'),
                    "UserMetadata" => [
                        "originKey" => $originKey,
                        "outputKey" => $outputKey
                    ],
                    "StatusUpdateInterval" => "SECONDS_10"
                ]);
                $jobId = $result['Job']['Id'];

                $extension = config('constants.transcode_extension');
            } else {
                // no need to process for mp4 type
                $processed = config('constants.video_convert_status.complete');
            }
        } catch (MultipartUploadException $e) {
            \Log::info($e->getMessage());
            return false;
        } catch (AwsException $e) {
            \Log::info($e->getMessage());
            return false;
        } 

        // add new record
        $video = $this->repository->create([
            'user_id' => user()->id,
            'path' => $outputKey,
            'extension' => $extension,
            'mime' => guess_mime_type($extension),
            'data' => null,
            'type' => config('constants.file_type.video'),
            'processed' => $processed,
            'job_id' => $jobId
        ]);
        return $video;
    }
}
