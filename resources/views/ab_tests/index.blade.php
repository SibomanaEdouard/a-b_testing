@extends('layouts.app')

@section('content')
    <h1>A/B Tests</h1>

    <a href="{{ route('ab_tests.create') }}">Create New A/B Test</a>

    @foreach($abTests as $abTest)
        <div>
            <h2>{{ $abTest->name }} ({{ $abTest->status }})</h2>
            <ul>
                @foreach($abTest->variants as $variant)
                    <li>{{ $variant->name }} (Ratio: {{ $variant->ratio }})</li>
                @endforeach
            </ul>

            @if($abTest->status === 'running')
                <form action="{{ route('ab_tests.stop', $abTest) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit">Stop</button>
                </form>
            @elseif($abTest->status === 'not_started')
                <form action="{{ route('ab_tests.start', $abTest) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit">Start</button>
                </form>
            @else
                <!-- No action available for tests that are stopped -->
                <p>This A/B test is stopped and cannot be restarted.</p>
            @endif
        </div>
    @endforeach
@endsection
