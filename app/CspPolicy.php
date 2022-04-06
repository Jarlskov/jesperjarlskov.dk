<?php

namespace App;

use Spatie\Csp\Directive;
use Spatie\Csp\Policies\Policy;

class CspPolicy extends Policy
{
    public function configure(): void
    {
        $this->setDefaultPolicies();
        $this->addBootstrapPolicies();
        $this->addGoogleFontPolicies();
        $this->addGoogleAnalyticsPolicies();
        $this->addGravatarPolicies();
    }

    protected function setDefaultPolicies(): Policy
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

    protected function addBootstrapPolicies(): Policy
    {
        return $this->addDirective(Directive::STYLE, 'maxcdn.bootstrapcdn.com')
            ->addDirective(Directive::FONT, 'maxcdn.bootstrapcdn.com')
            ->addDirective(Directive::CONNECT, 'cdn.jsdelivr.net');
    }

    protected function addGoogleFontPolicies(): void
    {
        $this->addDirective(Directive::FONT, [
            'fonts.gstatic.com',
            'fonts.googleapis.com',
            'data: '
        ])->addDirective(Directive::STYLE, 'fonts.googleapis.com');
    }

    protected function addGoogleAnalyticsPolicies(): void
    {
        $this->addDirective(Directive::SCRIPT, '*.googletagmanager.com')
            ->addDirective(Directive::SCRIPT, '*.google-analytics.com')
            ->addNonceForDirective(Directive::SCRIPT);
    }

    protected function addGravatarPolicies(): void
    {
        $this->addDirective(Directive::IMG, '*.gravatar.com');
    }
}
