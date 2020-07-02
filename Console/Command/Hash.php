<?php
/**
 * Copyright © Hampus Westman 2020
 * See LICENCE provided with this module for licence details
 *
 * @author     Hampus Westman <hampus.westman@gmail.com>
 * @copyright  Copyright (c)  2020 Hampus Westman
 * @license    MIT License https://opensource.org/licenses/MIT
 * @link       https://github.com/Pr00xxy
 *
 */

namespace PrOOxxy\DevStuff\Console\Command;

use Magento\Framework\Encryption\EncryptorInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Hash extends Command
{

    /**
     * @var EncryptorInterface
     */
    private $encryptor;

    /**
     * @var null
     */
    private $name;

    public function __construct(
        EncryptorInterface $encryptor,
        $name = null
    ) {
        parent::__construct($name);
        $this->encryptor = $encryptor;
        $this->name = $name;
    }

    protected function configure()
    {
        $this->setName('devstuff:hash')->setDescription('description');
        $this->addArgument(
            'input',
            InputArgument::REQUIRED,
            'Encrypt a string with the current crypt key'
        );
        parent::configure();
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $hash = $this->encryptor->encrypt($input->getArgument('input'));
        $output->writeln($hash);
    }
}
