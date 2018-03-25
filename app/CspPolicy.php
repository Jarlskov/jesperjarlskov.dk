<?php

namespace App;

use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Policy;

class CspPolicy extends Policy
{
    public function configure()
    {
        $this->setDefaultPolicies();
        $this->addBootstrapPolicies();
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
            ->addDirective(Directive::IMG, [
                'self',
                'data:'
            ])
            ->addDirective(Directive::MEDIA, 'self')
            ->addDirective(Directive::OBJECT, 'self')
            ->addDirective(Directive::SCRIPT, 'self')
            ->addDirective(Directive::STYLE, 'self')
            ->addDirective(Directive::FONT, 'self');
    }

    protected function addBootstrapPolicies()
    {
        return $this->addDirective(Directive::STYLE, 'maxcdn.bootstrapcdn.com')
            ->addDirective(Directive::CONNECT, 'cdn.jsdelivr.net');
    }

    protected function addGoogleFontPolicies()
    {
        $this->addDirective(Directive::FONT, [
            'fonts.gstatic.com',
            'fonts.googleapis.com',
            'data: '
        ])->addDirective(Directive::STYLE, 'fonts.googleapis.com');
    }

    protected function addGoogleAnalyticsPolicies()
    {
        $this->addDirective(Directive::SCRIPT, '*.googletagmanager.com')
            ->addDirective(Directive::SCRIPT, '*.google-analytics.com')
            ->addNonceForDirective(Directive::SCRIPT);
    }

    protected function addGravatarPolicies()
    {
        $this->addDirective(Directive::IMG, '*.gravatar.com');
    }
}
