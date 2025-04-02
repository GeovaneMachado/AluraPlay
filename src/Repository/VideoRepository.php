<?php

namespace Alura\Mvc\Repository;

use Alura\Mvc\Entity\Video;
use PDO;

class VideoRepository
{
    public function __construct(private PDO $pdo)
    {
    }

    public function add(Video $video): bool
    {
        $sql = 'INSERT INTO videos (title, url) VALUES (:title, :url)';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':title', $video->title);
        $statement->bindValue(':url', $video->url);

        $result = $statement->execute();

        if ($result) {
            $id = $this->pdo->lastInsertId();
            $video->setId((int) $id);
        }
        return $result;
    }

    public function update(Video $video): bool
    {
        $sql = 'UPDATE videos SET url = :url, title = :title WHERE id = :id';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':url', $video->url);
        $statement->bindValue(':title', $video->title);
        $statement->bindValue(':id', $video->id, PDO::PARAM_INT);

        return $statement->execute();
    }

    public function remove(int $id): bool
    {
        $sql = 'DELETE FROM videos WHERE id = :id';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        return $statement->execute();
    }

    /**
     * @return Video[]
     */
    public function all(): array
    {
        $videoList = $this->pdo
            ->query('SELECT * FROM videos;')
            ->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            function (array $videoData) {
                return $this->hydrateVideo($videoData);
            },
            $videoList
        );
    }

    public function find(int $id): ?Video
    {
        $statement = $this->pdo->prepare('SELECT * FROM videos WHERE id = ?;');
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null; // ou trate conforme sua necessidade
        }
        return $this->hydrateVideo($data);
    }

    private function hydrateVideo(array $videoData): Video
    {
        $video = new Video($videoData['url'], $videoData['title']);
        $video->setId((int)$videoData['id']);

        return $video;
    }
}
