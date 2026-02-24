<select id="subjectFilter" class="border p-2 rounded mb-4">
    <option value="">All Subjects</option>
    @foreach($subjects as $subject)
        <option value="{{ $subject->id }}">
            {{ $subject->name }}
        </option>
    @endforeach
</select>

<table class="w-full border">
    <thead>
        <tr>
            <th>Title</th>
            <th>Subject</th>
        </tr>
    </thead>
    <tbody id="testsTable">
        @foreach($tests as $test)
            <tr>
                <td>{{ $test->title }}</td>
                <td>{{ $test->subject->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
document.getElementById('subjectFilter').addEventListener('change', function() {

    let subjectId = this.value;

    fetch("{{ route('teacher.tests.filter') }}?subject_id=" + subjectId)
        .then(response => response.json())
        .then(data => {

            let table = document.getElementById('testsTable');
            table.innerHTML = '';

            data.forEach(test => {
                table.innerHTML += `
                    <tr>
                        <td>${test.title}</td>
                        <td>${test.subject.name}</td>
                    </tr>
                `;
            });

        });
});
</script>