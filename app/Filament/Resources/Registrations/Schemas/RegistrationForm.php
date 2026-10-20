<?php

namespace App\Filament\Resources\Registrations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RegistrationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('course_id')
                ->label('Capacitación')
                ->relationship('course', 'title')
                ->searchable()
                ->preload()
                ->required(),

            TextInput::make('full_name')
                ->label('Nombres y apellidos')
                ->required()
                ->maxLength(255),

            TextInput::make('dni')
                ->label('DNI o documento')
                ->required()
                ->maxLength(20),

            TextInput::make('email')
                ->label('Correo electrónico')
                ->email()
                ->required()
                ->maxLength(255),

            TextInput::make('phone')
                ->label('Teléfono')
                ->tel()
                ->maxLength(30),

            Select::make('status')
                ->label('Estado de participación')
                ->options([
                    'registered' => 'Inscrito',
                    'attended' => 'Asistió',
                    'absent' => 'No asistió',
                ])
                ->default('registered')
                ->required(),
        ]);
    }
}