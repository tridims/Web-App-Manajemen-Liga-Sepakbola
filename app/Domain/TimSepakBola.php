<?php

namespace Tridi\ManajemenLiga\Domain;

class TimSepakBola
{
    public ?int $id;
    public string $namaTim;
    public string $deskripsi;
    public string $asal;
    public $logo;
    public string $stadium;
    public string $pelatih;
    public string $pemilik;
    public ?array $daftarPertandingan;

    public function __construct(?int $id, string $namaTim, string $deskripsi, string $asal, ?string $logo = null, string $stadium, string $pelatih, string $pemilik)
    {
        $this->id = $id;
        $this->namaTim = $namaTim;
        $this->deskripsi = $deskripsi;
        $this->asal = $asal;
        $this->logo = $logo;
        $this->stadium = $stadium;
        $this->pelatih = $pelatih;
        $this->pemilik = $pemilik;
    }

    public function getTotalPoint(): int
    {
        $totalPoin = 0;
        foreach ($this->daftarPertandingan as $pertandingan) {
            $totalPoin += $pertandingan->getScoreForTim($this->id);
        }
        return $totalPoin;
    }

    public function getPointWithOpponent(TimSepakBola $tim): int
    {
        $poin = 0;
        foreach ($this->daftarPertandingan as $pertandingan) {
            if (in_array($this->id, $pertandingan->getArrayIdTeam()) && in_array($tim->id, $pertandingan->getArrayIdTeam())) {
                $poin += $pertandingan->getScoreForTim($this->id);
            }
        }
        return $poin;
    }

    public function getGoalDifferenceWithOpponent(TimSepakBola $tim): int
    {
        $totalGol = 0;
        foreach ($this->daftarPertandingan as $pertandingan) {
            if (in_array($this->id, $pertandingan->getArrayIdTeam()) && in_array($tim->id, $pertandingan->getArrayIdTeam())) {
                $totalGol += $pertandingan->getSelisihGol();
            }
        }
        return $totalGol;
    }

    public function getTotalGoalWithOpponent(TimSepakBola $tim): int
    {
        $totalGol = 0;
        foreach ($this->daftarPertandingan as $pertandingan) {
            if (in_array($this->id, $pertandingan->getArrayIdTeam()) && in_array($tim->id, $pertandingan->getArrayIdTeam())) {
                $totalGol += $pertandingan->getTotalGoalFromTeam($this->id);
            }
        }
        return $totalGol;
    }
}
