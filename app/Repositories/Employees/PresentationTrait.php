<?php

namespace App\Repositories\Employees;

use Laravolt\Avatar\Avatar;

trait PresentationTrait
{
    /**
     * [getGender description]
     * @return [type] [description]
     */
    public function getGender()
    {
        return self::DISPLAY_GENDER[$this->gender ?? self::FEMALE];
    }

    /**
     * [getStatus description]
     * @return [type] [description]
     */
    public function getStatus()
    {
        return self::DISPLAY_STATUS[$this->status ?? self::DISABLE];
    }

    /**
     * [getAvatarLinkAttribute description]
     * @return [type] [description]
     */
    public function getAvatar()
    {
        $avatar = new Avatar(config('avatar'));
        $issetImg = \Storage::disk('local')->exists($this->avatar);

        return ($this->avatar && $issetImg) ?
            app('url')->asset($this->imgPath . '/' . $this->avatar) :
            $avatar->create($this->name)->toBase64()->encoded;
    }

    public function getFormatDateOfBirth()
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d', $this->date_of_birth)->format('d-m-Y');
    }
}
