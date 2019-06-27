<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class LikedTeam
 * @package App
 */
class LikedTeam extends Model
{
    protected $fillable = [
        'name', 'conference', 'division', 'city', 'abbreviation'
    ];

    /**
     * @param string $abbr
     * @param string $name
     * @return string
     */
    public static function getFullLink(string $abbr, string $name) : string
    {
        // If team is New Orlean Pelicans
        if($abbr === 'NOP') {
            $abbr = 'NO';

            return config('teamsLink.TEAM_LINK').self::abbrToLower($abbr).'/'.self::getFullName($name);
        }

        // If team is Utah Jazz
        if($abbr === 'UTA') {
            $abbr = 'UTAH';

            return config('teamsLink.TEAM_LINK').self::abbrToLower($abbr).'/'.self::getFullName($name);
        }

        return config('teamsLink.TEAM_LINK').self::abbrToLower($abbr).'/'.self::getFullName($name);
    }

    /**
     * Transform abbreviation to lowercase
     * @param string $abbr
     * @return string
     */
    public static function abbrToLower(string $abbr) : string
    {
        return mb_strtolower($abbr);
    }

    /**
     * @param string $full_name
     * @return string
     */
    public static function getFullName(string $full_name) : string
    {
        return Str::slug($full_name, '-');
    }

    /**
     * @param $abbr
     * @return string
     */
    public static function getAvatar($abbr)
    {
        // If team is New Orlean Pelicans
        if($abbr === 'NOP') {
            $abbr = 'NO';
        }

        // If team is Utah Jazz
        if($abbr === 'UTA') {
            $abbr = 'UTAH';
        }

        $abbr = self::abbrToLower($abbr);

        return file_exists(public_path('/img/teams/'.$abbr.'.png'))
            ? asset('img/teams/'.$abbr.'.png')
            : asset('img/teams/no_image.png');
    }

    public static function addLinkAndFullName(array $teams) : array
    {
        foreach ($teams as $team) {
            $team->link = self::getFullLink($team->abbreviation, $team->full_name);
            $team->image = self::getAvatar($team->abbreviation);
        }

        return $teams;
    }
}
