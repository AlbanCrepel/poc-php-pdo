<?php

class Post
{
    private ?int $id;
    private string $title;
    private ?string $description;
    private int $userId;
    private ?string $createdAt;

    public function __construct(
        string $title,
        ?string $description,
        int $userId,
        ?int $id = null,
        ?string $createdAt = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->userId = $userId;
        $this->createdAt = $createdAt;
    }

    public static function fromArray(array $row): self
    {
        return new self(
            title: $row['title'],
            description: $row['description'] ?? null,
            userId: (int) $row['user_id'],
            id: isset($row['id']) ? (int) $row['id'] : null,
            createdAt: $row['created_at'] ?? null
        );
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }
}
