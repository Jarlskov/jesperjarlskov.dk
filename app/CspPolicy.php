<?php

namespace App;

use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Policy;

class CspPolicy extends Policy
{
    public function configure()
    {
        $this->setDefaultPolicies();
        $this->addGoogleFontPolicies();
        $this->addGoogleAnalyticsPolicies();
        $this->addGravatarPolicies();
    }

    protected function setDefaultPolicies()
    {
        return $this->addDirective(Directive::BASE, 'self')
            ->addDirective(Directive::CONNECT, 'self')
            ->addDirective(Directive::DEFAULT, 'self')
            ->addDirective(Directive::FORM_ACTION, 'self')
            ->addDirective(Directive::IMG, 'self')
            ->addDirective(Directive::MEDIA, 'self')
            ->addDirective(Directive::OBJECT, 'self')
            ->addDirective(Directive::SCRIPT, 'self')
            ->addDirective(Directive::STYLE, 'self')
            ->addDirective(Directive::SCRIPT, 'localhost')
            ->addDirective(Directive::STYLE, 'localhost');
    }

    protected function addGoogleFontPolicies()
    {
        $this->addDirective(Directive::FONT, [
            'fonts.gstatic.com',
            'fonts.googleapis.com',
            'data:',
        ])->addDirective(Directive::STYLE, 'fonts.googleapis.com');
    }

    protected function addGoogleAnalyticsPolicies()
    {
        $this->addDirective(Directive::SCRIPT, '*.googletagmanager.com')
            ->addNonceForDirective(Directive::SCRIPT);
    }

    protected function addGravatarPolicies()
    {
        $this->addDirective(Directive::IMG, '*.gravatar.com');
    }
}
