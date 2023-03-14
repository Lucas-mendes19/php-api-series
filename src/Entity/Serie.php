<?php

namespace Lukelt\Api\Entity;

class Serie
{
    public readonly int $id;
    public readonly string $name;
    public readonly int $season;
    public readonly int $episode;

    public static function withIdNameSeasonEpísode(int $id, string $name, int $season, int $episode): Serie
    {
        $serie = new Serie($name, $season, $episode);
        $serie->setId($id);
    
        return $serie;
    }

    public function __construct(string $name, int $season, int $episode)
    {
        $this->setName($name);
        $this->setSeason($season);
        $this->setEpisode($episode);
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setSeason(int $season): void
    {
        $this->season = $season;
    }

    public function setEpisode(int $episode): void
    {
        $this->episode = $episode;
    }
}