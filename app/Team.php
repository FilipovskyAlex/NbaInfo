<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{


    public static function getFullLink(string $abbr, string $name) : string
    {
        if($abbr === 'NOP') {
            $abbr = 'NO';

            return config('teamsLink.TEAM_LINK').self::abbrToLower($abbr).'/'.self::getFullName($name);
        }

        if($abbr === 'UTA') {
            $abbr = 'UTAH';

            return config('teamsLink.TEAM_LINK').self::abbrToLower($abbr).'/'.self::getFullName($name);
        }

        return config('teamsLink.TEAM_LINK').self::abbrToLower($abbr).'/'.self::getFullName($name);
    }

    public static function abbrToLower(string $abbr) : string
    {
        return mb_strtolower($abbr);
    }

    public static function getFullName(string $full_name) : string
    {
        return str_replace(' ', '-', mb_strtolower($full_name));
    }

    public static function getAvatar($abbr)
    {
        if($abbr === 'NOP') {
            $abbr = 'NO';
        }

        if($abbr === 'UTA') {
            $abbr = 'UTAH';
        }

        $abbr = self::abbrToLower($abbr);

        return file_exists(public_path('/img/teams/'.$abbr.'.png'))
            ? asset('img/teams/'.$abbr.'.png')
            : asset('img/teams/no_image.png');
    }
}
