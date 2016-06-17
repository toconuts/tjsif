<?php

/*
 * This file is part of the TJ-SIF 2016 project.
 *
 * (c) toconuts <toconuts@google.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Description of ImageStringToFileTransformer
 *
 * @author Juanjo García
 */
class ImageStringToFileTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }
    
    /**
     * Transforms a string (base64) to an object (File).
     *
     * @param  string $imageString
     * @return File|null
     * @throws TransformationFailedException if no object (File)
     */
    public function reverseTransform($imageString)
    {
        // no base64? It's optional, so that's ok       
        if (!$imageString) {
            return;
        }

        preg_match('/data:([^;]*);base64,(.*)/', $imageString, $matches);

        $mimeType = $matches[1];
        $imagenDecodificada = base64_decode($matches[2]);
        $filePath = sys_get_temp_dir() . "/" . uniqid() . '.png';
        file_put_contents($filePath, $imagenDecodificada);

        $file = new UploadedFile($filePath, "user.png", $mimeType, null, null, true);

        if (null === $file) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                 'An issue with number "%s" does not exist!', $imageString
            ));
        }

        return $file;
    }
    
    /**
     * Transforms an object (File) to a string (base64).
     *
     * @param  File|null $file
     * @return string
     */
    public function transform($file)
    {
        return '';
    }
}
