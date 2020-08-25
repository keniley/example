<?php

namespace App\Service;

use Illuminate\Support\Facades\Mail;

class Email
{
    /**
     * @var bool
     */
    private $isChannelSet = false;

    public function channel(string $channel): Email
    {
        $this->destroy();
        $this->create($channel);

        $this->isChannelSet = true;

        return $this;
    }

    public function __call(string $name, array $arguments)
    {
        if($this->isChannelSet !== true) {
            $this->channel('default');
        }

        return Mail::$name($arguments);
    }

    private function create(string $channel): Email 
    {
        $config = $this->getConfig($channel);
        $this->setConfig($config);

        $mailer = new \Illuminate\Mail\MailServiceProvider(app());
        $mailer->register();

        return $this;
    }

    private function getConfig(string $channel): array
    {
        $driver = 'log';

        if(config('app.env') === 'production') {
            $driver = config('email.channels.'.$channel.'.driver', config('mail.driver'));
        }

        return [
            'driver' => $driver,
            'host' => config('email.channels.'.$channel.'.host', config('mail.host')),
            'port' => config('email.channels.'.$channel.'.port', config('mail.port')),
            'username' => config('email.channels.'.$channel.'.username', config('mail.username')),
            'password' => config('email.channels.'.$channel.'.password', config('mail.password')),
            'encryption' => config('email.channels.'.$channel.'.encryption', config('mail.encryption')),
            'address' => config('email.channels.'.$channel.'.from.address', config('mail.from.address')),
            'name' => config('email.channels.'.$channel.'.from.name', config('mail.from.name')),
        ];
    }

    private function setConfig(array $config)
    {
         config([
            'mail.driver' => $config['driver'],
            'mail.host' => $config['host'],
            'mail.port' => $config['port'],
            'mail.username' => $config['username'],
            'mail.password' => $config['password'],
            'mail.encryption' => $config['encryption'],
            'mail.from.address' => $config['address'],
            'mail.from.name' => $config['name'],   
        ]);
    }

    private function destroy(): Email
    {
        unset(app()['mailer']);

        return $this; 
    }
}