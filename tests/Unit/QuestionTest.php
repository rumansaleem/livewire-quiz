<?php

namespace Tests\Unit;

use App\Exceptions\UnknownOptionKey;
use App\Question;
use App\Quiz;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_text()
    {
        $question = factory(Question::class)->create();

        $this->assertNotNull($question->text);
    }

    public function test_it_has_array_of_options()
    {
        $question = factory(Question::class)->create([
            'options' => $options = [
                'a' => 'apple',
                'b' => 'banana',
                'c' => 'custard apple',
                'd' => 'dragon fruit'
            ]
        ]);

        $this->assertIsArray($question->options);
        $this->assertEquals($options, $question->options);
    }

    public function test_is_correct_method()
    {
        $question = factory(Question::class)->create([
            'options' => $options = [
                'a' => 'apple',
                'b' => 'banana',
                'c' => 'custard apple',
                'd' => 'dragon fruit'
            ],
            'correct_key' => 'b'
        ]);

        $this->assertTrue($question->isCorrect('b'));
        $this->assertFalse($question->isCorrect('a'));
        $this->assertFalse($question->isCorrect('c'));
        $this->assertFalse($question->isCorrect('d'));
    }

    public function test_correct_key_always_exist_in_options()
    {
        $this->expectException(UnknownOptionKey::class);

        $question = factory(Question::class)->create([
            'options' => $options = [
                'a' => 'apple',
                'b' => 'banana',
                'c' => 'custard apple',
                'd' => 'dragon fruit'
            ],
            'correct_key' => 'XYZ'
        ]);

        $this->assertNull($question);
    }

    public function test_it_belongs_to_a_quiz()
    {
        $quiz = factory(Quiz::class)->create();
        $question = factory(Question::class)->create(['quiz_id' => $quiz->id]);

        $this->assertInstanceof(BelongsTo::class, $question->quiz());
        $this->assertInstanceof(Quiz::class, $question->quiz);
        $this->assertTrue($quiz->is($question->quiz), 'Quiz models do not match.');
    }
}
