<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240827101843 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insert math questions and answers into the database';
    }

    public function up(Schema $schema): void
    {
        // Question 1: 1 + 1 = ?
        $this->addSql("INSERT INTO question (id, text) VALUES (1, '1 + 1 = ?')");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (1, '3', 1)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (2, '2', 1)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (3, '0', 1)");
        $this->addSql("INSERT INTO correct_answer (id, correct_combinations, question_id) VALUES (1, '[2]', 1)");

        // Question 2: 2 + 2 = ?
        $this->addSql("INSERT INTO question (id, text) VALUES (2, '2 + 2 = ?')");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (4, '4', 2)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (5, '3 + 1', 2)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (6, '10', 2)");
        $this->addSql("INSERT INTO correct_answer (id, correct_combinations, question_id) VALUES (4, '[4,5]', 2)");

        // Question 3: 3 + 3 = ?
        $this->addSql("INSERT INTO question (id, text) VALUES (3, '3 + 3 = ?')");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (7, '1 + 5', 3)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (8, '1', 3)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (9, '6', 3)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (10, '2 + 4', 3)");
        $this->addSql("INSERT INTO correct_answer (id, correct_combinations, question_id) VALUES (8, '[7,9,10]', 3)");

        // Question 4: 4 + 4 = ?
        $this->addSql("INSERT INTO question (id, text) VALUES (4, '4 + 4 = ?')");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (11, '8', 4)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (12, '4', 4)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (13, '0', 4)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (14, '0 + 8', 4)");
        $this->addSql("INSERT INTO correct_answer (id, correct_combinations, question_id) VALUES (11, '[11,14]', 4)");

        // Question 5: 5 + 5 = ?
        $this->addSql("INSERT INTO question (id, text) VALUES (5, '5 + 5 = ?')");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (15, '6', 5)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (16, '18', 5)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (17, '10', 5)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (18, '9', 5)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (19, '0', 5)");
        $this->addSql("INSERT INTO correct_answer (id, correct_combinations, question_id) VALUES (12, '[17]', 5)");

        // Question 6: 6 + 6 = ?
        $this->addSql("INSERT INTO question (id, text) VALUES (6, '6 + 6 = ?')");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (20, '3', 6)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (21, '9', 6)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (22, '0', 6)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (23, '12', 6)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (24, '5 + 7', 6)");
        $this->addSql("INSERT INTO correct_answer (id, correct_combinations, question_id) VALUES (15, '[23,24]', 6)");

        // Question 7: 7 + 7 = ?
        $this->addSql("INSERT INTO question (id, text) VALUES (7, '7 + 7 = ?')");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (25, '5', 7)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (26, '14', 7)");
        $this->addSql("INSERT INTO correct_answer (id, correct_combinations, question_id) VALUES (16, '[26]', 7)");

        // Question 8: 8 + 8 = ?
        $this->addSql("INSERT INTO question (id, text) VALUES (8, '8 + 8 = ?')");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (27, '16', 8)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (28, '12', 8)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (29, '9', 8)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (30, '5', 8)");
        $this->addSql("INSERT INTO correct_answer (id, correct_combinations, question_id) VALUES (17, '[27]', 8)");

        // Question 9: 9 + 9 = ?
        $this->addSql("INSERT INTO question (id, text) VALUES (9, '9 + 9 = ?')");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (31, '18', 9)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (32, '9', 9)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (33, '17 + 1', 9)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (34, '2 + 16', 9)");
        $this->addSql("INSERT INTO correct_answer (id, correct_combinations, question_id) VALUES (18, '[31]', 9)");
        $this->addSql("INSERT INTO correct_answer (id, correct_combinations, question_id) VALUES (19, '[33]', 9)");
        $this->addSql("INSERT INTO correct_answer (id, correct_combinations, question_id) VALUES (20, '[34]', 9)");
        $this->addSql("INSERT INTO correct_answer (id, correct_combinations, question_id) VALUES (21, '[31,33,34]', 9)");

        // Question 10: 10 + 10 = ?
        $this->addSql("INSERT INTO question (id, text) VALUES (10, '10 + 10 = ?')");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (35, '0', 10)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (36, '2', 10)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (37, '8', 10)");
        $this->addSql("INSERT INTO answer (id, text, question_id) VALUES (38, '20', 10)");
        $this->addSql("INSERT INTO correct_answer (id, correct_combinations, question_id) VALUES (22, '[38]', 10)");
    }

    public function down(Schema $schema): void
    {
        // In case of rollback, we remove the inserted data
        $this->addSql('DELETE FROM correct_answer WHERE question_id BETWEEN 1 AND 10');
        $this->addSql('DELETE FROM answer WHERE question_id BETWEEN 1 AND 10');
        $this->addSql('DELETE FROM question WHERE id BETWEEN 1 AND 10');
    }
}
