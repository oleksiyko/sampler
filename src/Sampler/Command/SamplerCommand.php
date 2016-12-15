<?php

namespace Sampler\Command;

use Sampler\Iterator\RandomCharactersIterator;
use Sampler\Iterator\ResourceIterator;
use Sampler\Sampler;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author: Oleksii Postolovskyi<oleksii.postolovskyi@auto1.com>
 *
 * Class SamplerCommand
 */
class SamplerCommand extends Command
{
    const SOURCE_TYPE_PIPELINE = 'STDIN';
    const SOURCE_TYPE_RANDOM = 'RND';
    const DEFAULT_SAMPLE_SIZE = 5;

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName('sample')
            ->setDescription('Command to sample streamed characters')
            ->addOption(
                'source-type',
                null,
                InputOption::VALUE_OPTIONAL,
                sprintf('Stream source type. Possible values: %s', implode(', ', self::getAllowedSourceTypes())),
                self::SOURCE_TYPE_PIPELINE
            )
            ->addOption(
                'size',
                null,
                InputOption::VALUE_OPTIONAL,
                sprintf('Sample size'),
                self::DEFAULT_SAMPLE_SIZE
            )
        ;
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sourceType = $input->getOption('source-type');
        $size = $input->getOption('size');

        if (!in_array($sourceType, self::getAllowedSourceTypes())) {
            $output->writeln('Invalid stream source type!');
            return;
        }

        switch ($sourceType) {
            case self::SOURCE_TYPE_PIPELINE:
                $stream = @fopen('php://stdin', 'r');
                $iterator = new ResourceIterator($stream);
                break;
            case self::SOURCE_TYPE_RANDOM:
                $iterator = new RandomCharactersIterator();
                break;
        }

        $sampler = new Sampler($iterator);
        $sample = $sampler->sample($size);
        $output->writeln(sprintf('Stream sample: %s', implode('', $sample)));
    }

    /**
     * @return array
     */
    private static function getAllowedSourceTypes()
    {
        return [self::SOURCE_TYPE_PIPELINE, self::SOURCE_TYPE_RANDOM];
    }
}
