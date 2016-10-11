<?php

namespace AppBundle\Command;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ResizePictureCommand
 * @package AppBundle\Command
 */
class ResizePictureCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
          ->setName('picture:resize')
          ->setDescription('Resize a single picture')
          ->addArgument(
            'path',
            InputArgument::REQUIRED,
            'Path to the picture you want to resize'
          )
          ->addOption(
            'size',
            '',
            InputOption::VALUE_OPTIONAL,
            'Size of the output picture (default 30 pixels)',
            300
          )
          ->addOption(
            'out',
            'o',
            InputOption::VALUE_OPTIONAL,
            'Folder which to output the picture (web/assets/images/resized)',
            realpath(__DIR__.'/../../../web/assets/images/resized/')
          );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Command line info
        $path = $input->getArgument('path');
        $size = $input->getOption('size');
        $out = $input->getOption('out');

        $progress = new ProgressBar($output, 1);
        $progress->start();

        // Prepare image and resize tool
        $imagine = new Imagine();
        $image = $imagine->open($path);
        $box = new Box($size, $size);
        $filename = basename($path);

        // Resize image
        $image
          ->thumbnail($box, ImageInterface::THUMBNAIL_OUTBOUND)
          ->save($out.'/'.$filename);

        $progress->advance();
        $progress->finish();

        $output->writeln('');
        $output->writeln(sprintf('<info>Success: %s --> %s</info>', $path, $out));
    }
}