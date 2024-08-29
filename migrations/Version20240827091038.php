<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240827091038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insert math questions and answers into the database';
    }

    public function up(Schema $schema): void
    {
        // Insert Questions
        $this->addSql("INSERT INTO question (id, text) VALUES (1, '1 + 1 = ?')");
        $this->addSql("INSERT INTO question (id, text) VALUES (2, '2 + 2 = ?')");
        $this->addSql("INSERT INTO question (id, text) VALUES (3, '3 + 3 = ?')");
        $this->addSql("INSERT INTO question (id, text) VALUES (4, '4 + 4 = ?')");
        $this->addSql("INSERT INTO question (id, text) VALUES (5, '5 + 5 = ?')");
        $this->addSql("INSERT INTO question (id, text) VALUES (6, '6 + 6 = ?')");
        $this->addSql("INSERT INTO question (id, text) VALUES (7, '7 + 7 = ?')");
        $this->addSql("INSERT INTO question (id, text) VALUES (8, '8 + 8 = ?')");
        $this->addSql("INSERT INTO question (id, text) VALUES (9, '9 + 9 = ?')");
        $this->addSql("INSERT INTO question (id, text) VALUES (10, '10 + 10 = ?')");

        // Insert Answers for Question 1
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (1, '3', 1)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (2, '2', 1)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (3, '0', 1)");

        // Insert Correct Combinations for Question 1
        $this->addSql("INSERT INTO correct_answer (id, correct_combinations, question_id) VALUES (1, '[2]', 1)");

        // Insert Answers for Question 2
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (4, '4', 2)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (5, '3 + 1', 2)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (6, '10', 2)");

        // Insert Correct Combinations for Question 2
        $this->addSql("INSERT INTO correct_answer (id, correct_combinations, question_id) VALUES (2, '[4]', 2)");
        $this->addSql("INSERT INTO correct_answer (id, correct_combinations, question_id) VALUES (3, '[5]', 2)");
        $this->addSql("INSERT INTO correct_answer (id, correct_combinations, question_id) VALUES (4, '[4,5]', 2)");

        // Repeat for all other questions and answers

        // Insert Answers and Correct Combinations for Question 3
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (7, '1 + 5', 3)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (8, '1', 3)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (9, '6', 3)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (10, '2 + 4', 3)");

        $this->addSql("INSERT INTO correct_answer (id, correct_combinations, question_id) VALUES (5, '[7]', 3)");
        $this->addSql("INSERT INTO correct_answer (id, correct_combinations, question_id) VALUES (6, '[9]', 3)");
        $this->addSql("INSERT INTO correct_answer (id, correct_combinations, question_id) VALUES (7, '[10]', 3)");
        $this->addSql("INSERT INTO correct_answer (id, correct_combinations, question_id) VALUES (8, '[7,9,10]', 3)");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM correct_answer WHERE question_id BETWEEN 1 AND 10');
        $this->addSql('DELETE FROM answer WHERE question_id BETWEEN 1 AND 10');
        $this->addSql('DELETE FROM question WHERE id BETWEEN 1 AND 10');
    }
}
