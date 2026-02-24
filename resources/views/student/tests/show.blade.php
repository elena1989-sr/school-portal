@extends('layouts.student')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-6">

    <h1 class="text-3xl font-bold mb-6">Test: {{ $test->title }}</h1>

    <form id="testForm">
        @foreach($test->questions as $question)
            <div class="mb-6 p-4 border rounded-lg shadow">
                <p class="font-semibold mb-2">{{ $loop->iteration }}. {{ $question->question }}</p>
                <div class="space-y-1">
                    <label class="flex items-center gap-2">
                        <input type="radio" name="question_{{ $question->id }}" value="A">
                        <span>A. {{ $question->option_a }}</span>
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" name="question_{{ $question->id }}" value="B">
                        <span>B. {{ $question->option_b }}</span>
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" name="question_{{ $question->id }}" value="C">
                        <span>C. {{ $question->option_c }}</span>
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" name="question_{{ $question->id }}" value="D">
                        <span>D. {{ $question->option_d }}</span>
                    </label>
                </div>
            </div>
        @endforeach

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600">
            Submit Test
        </button>
    </form>

</div>

<!-- Result Modal -->
<div id="resultModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-lg w-96 relative max-h-[80vh] overflow-y-auto">
        <button id="closeResult" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl">&times;</button>
        <h2 class="text-xl font-bold mb-4">Test Result</h2>
        <div id="resultSummary" class="mb-4 text-gray-700"></div>
        <ul id="resultDetails" class="space-y-2"></ul>
        <div style="margin-top:20px">
            <a href="{{ route('student.results.pdf', $test->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Download PDF
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>

   function getAnswers() {
        const answers = {};
        let sel;
        @foreach($test->questions as $question)
            sel = document.querySelector(`input[name="question_{{ $question->id }}"]:checked`);
            answers[{{ $question->id }}] = sel ? sel.value : null;
        @endforeach
        return answers;
    }


    const form = document.getElementById('testForm');
    form.addEventListener('submit', function(e){
        e.preventDefault();
        const testId = {{ $test->id }};
        const answers = getAnswers();

        fetch(`/student/tests/${testId}/submit`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({answers})
        })
        .then(res => res.json())
        .then(data => {
            if(data.error){
                alert(data.error);
                return;
            }

            const modal = document.getElementById('resultModal');
            const summary = document.getElementById('resultSummary');
            const details = document.getElementById('resultDetails');

            summary.innerHTML = `
                Total Questions: ${data.total} <br>
                Correct: ${data.correct} <br>
                Wrong: ${data.wrong} <br>
                Score: ${data.percentage} %
            `;

            details.innerHTML = '';
            data.details.forEach(d => {
                const li = document.createElement('li');
                li.classList.add('p-2', 'rounded', 'text-white', 'shadow');
                li.classList.add(d.is_correct ? 'bg-green-500' : 'bg-red-500');
                li.innerHTML = `<strong>${d.question}</strong><br>
                                Your Answer: ${d.your_answer ?? 'No answer'} | Correct: ${d.correct_answer}`;
                details.appendChild(li);
            });

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.getElementById('closeResult').addEventListener('click', function(){
                window.location.href = "{{ route('student.results.index') }}";
            });
        })
        .catch(err => console.error(err));
    });

   

</script>
@endsection