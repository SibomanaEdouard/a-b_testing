@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">A/B Tests</h1>

    <a href="{{ route('ab_tests.create') }}" class="btn btn-primary mb-4">Create New A/B Test</a>

    @foreach($abTests as $abTest)
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="card-title">{{ $abTest->name }} <span class="badge {{ $abTest->status === 'running' ? 'bg-success' : ($abTest->status === 'not_started' ? 'bg-warning' : 'bg-danger') }}">{{ $abTest->status }}</span></h2>
                <ul class="list-group list-group-flush">
                    @foreach($abTest->variants as $variant)
                        <li class="list-group-item">{{ $variant->name }} (Ratio: {{ $variant->ratio }})</li>
                    @endforeach
                </ul>

                <div class="mt-3">
                    @if($abTest->status === 'running')
                        <form action="{{ route('ab_tests.stop', $abTest) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger">Stop</button>
                        </form>
                    @elseif($abTest->status === 'not_started')
                        <form action="{{ route('ab_tests.start', $abTest) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">Start</button>
                        </form>
                    @else
                        <!-- No action available for tests that are stopped -->
                        <p class="text-muted done">This A/B test is stopped and cannot be restarted.</p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
