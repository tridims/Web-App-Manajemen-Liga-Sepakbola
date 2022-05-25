<?php

namespace Tridi\ManajemenLiga\Repository;

use Tridi\ManajemenLiga\Domain\Pertandingan;
use Tridi\ManajemenLiga\Model\Pertandingan\createPertandinganRequest;
use Tridi\ManajemenLiga\Model\Pertandingan\deletePertandinganRequest;
use Tridi\ManajemenLiga\Model\Pertandingan\updatePertandinganRequest;
use Tridi\ManajemenLiga\Service\Database;
use Tridi\ManajemenLiga\Repository\TimRepository;

class PertandinganRepository
{
    private TimRepository $timRepository;

    public function __construct()
    {
        $this->timRepository = new TimRepository();
    }

    /**
     * @throws \Exception
     */
    public function getPertandinganByTimId(int $timId): array
    {
        $sql = "select * from pertandingan where tim1 = :timId or tim2 = :timId";
        $params = [
            "timId" => $timId,
        ];
        $stmt = Database::query($sql, $params);

        return $this->createListPertandinganFromStatement($stmt);
    }

    /**
     * @throws \Exception
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM pertandingan";
        $stmt = Database::query($sql);
        return $this->createListPertandinganFromStatement($stmt);
    }

    /**
     * @throws \Exception
     */
    public function findById(int $id): Pertandingan
    {
        if ($id <= 0) {
            throw new \Exception("Id tidak valid");
        }

        $sql = "SELECT * FROM pertandingan WHERE id_pertandingan = :id";
        $params = [
            'id' => $id
        ];
        $stmt = Database::query($sql, $params);

        $row = $stmt->fetch();
        if ($row == null) {
            throw new \Exception("Pertandingan tidak ditemukan");
        }
        $tim1 = $this->timRepository->findById($row['tim1']);
        $tim2 = $this->timRepository->findById($row['tim2']);
        return new Pertandingan($row['id_pertandingan'], $tim1, $tim2, $row['jadwalPertandingan'], $row['jumlahGolTim1'], $row['jumlahGolTim2']);
    }

    public function savePertandingan(Pertandingan $pertandingan): void
    {
        $sql = "INSERT INTO pertandingan (jumlahGolTim1, jumlahGolTim2, jadwalPertandingan, tim1, tim2) VALUES (:jumlahGolTim1, :jumlahGolTim2, :jadwalPertandingan, :tim1, :tim2)";
        $params = [
            'jumlahGolTim1' => $pertandingan->jumlahGolTim1,
            'jumlahGolTim2' => $pertandingan->jumlahGolTim2,
            'jadwalPertandingan' => $pertandingan->jadwalMain,
            'tim1' => $pertandingan->tim1->id,
            'tim2' => $pertandingan->tim2->id
        ];

        $stmt = Database::exec($sql, $params);
    }

    public function updatePertandingan(Pertandingan $pertandingan): void
    {
        $sql = "UPDATE pertandingan SET tim1 = :tim1, tim2 = :tim2, jadwalPertandingan = :jadwalPertandingan, jumlahGolTim1 = :jumlahGolTim1, jumlahGolTim2 = :jumlahGolTim2 WHERE id_pertandingan = :idPertandingan";
        $params = [
            'tim1' => $pertandingan->tim1->id,
            'tim2' => $pertandingan->tim2->id,
            'jadwalPertandingan' => $pertandingan->jadwalMain,
            'jumlahGolTim1' => $pertandingan->jumlahGolTim1,
            'jumlahGolTim2' => $pertandingan->jumlahGolTim2,
            'idPertandingan' => $pertandingan->id
        ];
        $stmt = Database::exec($sql, $params);
    }

    public function deletePertandingan(Pertandingan $pertandingan): void
    {
        $sql = "DELETE FROM pertandingan WHERE id_pertandingan = :idPertandingan";
        $params = [
            'idPertandingan' => $pertandingan->id
        ];
        $stmt = Database::exec($sql, $params);
    }

    /**
     * @param bool|\PDOStatement $stmt
     * @return array
     * @throws \Exception
     */
    public function createListPertandinganFromStatement(bool|\PDOStatement $stmt): array
    {
        $listPertandingan = [];
        while ($row = $stmt->fetch()) {
            $tim1 = $this->timRepository->findById($row['tim1']);
            $tim2 = $this->timRepository->findById($row['tim2']);
            $pertandingan = new Pertandingan($row['id_pertandingan'], $tim1, $tim2, $row['jadwalPertandingan'], $row['jumlahGolTim1'], $row['jumlahGolTim2']);
            $listPertandingan[] = $pertandingan;
        }
        return $listPertandingan;
    }

    public function deleteAll(): void
    {
        $sql = "DELETE FROM pertandingan";
        $stmt = Database::exec($sql);
    }
}
