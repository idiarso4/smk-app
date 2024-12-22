<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;

class Login extends BaseLogin
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->autocomplete('email')
                    ->placeholder('nama@email.com')
                    ->autofocus(),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required()
                    ->placeholder('••••••••'),
                Checkbox::make('remember')
                    ->label('Remember me'),
            ]);
    }

    public function getHeading(): string
    {
        return 'Selamat Datang di SMKN 1 Punggelan';
    }

    public function getSubheading(): string 
    {
        return 'Silakan masuk untuk melanjutkan';
    }

    public function getView(): string 
    {
        return 'filament.pages.auth.login';
    }
} 