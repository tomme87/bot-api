<?php


namespace App\Command;


use phpseclib\Crypt\RSA;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class BAGenerateKeysCommand extends Command {
  protected static $defaultName = 'ba:generate-keys';
  /**
   * @var ParameterBagInterface
   */
  private $params;

  public function __construct(ParameterBagInterface $params) {
    $this->params = $params;

    parent::__construct();
  }

  protected function configure() {
    $this
      ->setDescription('Create keys for encryption and signing');
  }

  protected function execute(InputInterface $input, OutputInterface $output) {
    $rsa = new RSA();
    $io = new SymfonyStyle($input, $output);

    $keys = $rsa->createKey(4096);
    $publicKey = $keys['publickey'];
    $privateKey = $keys['privatekey'];

    file_put_contents($this->params->get('ba.keys.oauth.private'), $privateKey);
    file_put_contents($this->params->get('ba.keys.oauth.public'), $publicKey);

    $io->note('Encryption keys generated successfully.');
  }
}
