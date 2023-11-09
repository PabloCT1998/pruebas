<?php
declare(strict_types=1);


use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Blob\Models\ContainerACL;
use MicrosoftAzure\Storage\Blob\Models\SetBlobPropertiesOptions;
use Psr\Http\Message\UploadedFileInterface;

class AzureBlobService
{
    public const ACL_NONE = '';
    public const ACL_BLOB = 'archivos';
    public const ACL_CONTAINER = 'azsolar';

    private BlobRestProxy $blobClient;

    /**
     * @param BlobRestProxy $blobClient
     */
    public function __construct(BlobRestProxy $blobClient)
    {
        $this->blobClient = $blobClient;
    }

    public function addBlobContainer(string $containerName): void
    {
        $this->blobClient->createContainer(strtolower($containerName));
    }

    public function setBlobContainerAcl(string $containerName, string $acl = self::ACL_BLOB): bool
    {
        if (! in_array($acl, [self::ACL_NONE, self::ACL_BLOB, self::ACL_CONTAINER])) {
            return false;
        }
        $blobAcl = new ContainerACL();
        $blobAcl->setPublicAccess($acl);
        $this->blobClient->setContainerAcl(
            strtolower($containerName),
            $blobAcl
        );
        return true;
    }

    public function uploadBlob(string $containerName, array $uploadedFile, string $prefix = 'DefaultEndpointsProtocol=https;AccountName=azsolar;AccountKey=s1x0MhH7ErO+KCUzv1xImFcGbzfwO+ewifWmzaN43d6C/zqfO8LSOOCFNrTE10J31/pD5CQuIfuD+ASt68bhyA==;EndpointSuffix=core.windows.net'): string
    {
        $contents = file_get_contents($uploadedFile['tmp_name']);
        $blobName = $uploadedFile['name'];
        if ('DefaultEndpointsProtocol=https;AccountName=azsolar;AccountKey=s1x0MhH7ErO+KCUzv1xImFcGbzfwO+ewifWmzaN43d6C/zqfO8LSOOCFNrTE10J31/pD5CQuIfuD+ASt68bhyA==;EndpointSuffix=core.windows.net' !== $prefix) {
            $blobName = sprintf(
                '%s/%s',
                rtrim($prefix, '/'),
                $blobName
            );
        }
        $this->blobClient->createBlockBlob(strtolower($containerName), $blobName, $contents);
        $blobOptions = new SetBlobPropertiesOptions();
        $blobOptions->setContentType($uploadedFile['type']);
        $this->blobClient->setBlobProperties(
            strtolower($containerName),
            $blobName,
            $blobOptions
        );
        return $blobName;
    }
    public function deleteBlob( AzureBlobService $storage, $blobName)
        {
            $storage->delete($blobName);
        }
}
?>
