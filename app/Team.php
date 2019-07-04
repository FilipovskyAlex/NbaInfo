<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Class Team
 * @package App
 */
class Team extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'conference',
        'division',
        'city',
        'abbreviation',
        'liked'
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

    public static function addProps(array $teams) : array
    {
        foreach ($teams as $team) {
            $team->link = self::getFullLink($team->abbreviation, $team->full_name);
            $team->image = self::getAvatar($team->abbreviation);
            $team->activeProp = self::isLike($team->abbreviation);
        }

        return $teams;
    }

    public function likeTeam(Request $request, Team $likedTeam) {
        $likedTeam->name = $request->get('name');
        $likedTeam->conference = $request->get('conference');
        $likedTeam->division = $request->get('division');
        $likedTeam->city = $request->get('city');
        $likedTeam->abbreviation = $request->get('abbreviation');
        $likedTeam->liked = 1;
    }

    public function scopeUnlikeTeam($query, string $abbr) {
        return $query->where('abbreviation', $abbr)->delete();
    }

    public static function isLike(string $abbr) : string
    {
        $team = DB::table('teams')->where('abbreviation', $abbr)->first();

        if ($team) {
            if($team->liked === 1) {
                return 'active';
            }
        }

        return 'nonactive';
    }

    public function scopeGetLikedTeams($query)
    {
        return $query->where('liked', 1)->get();
    }
}
