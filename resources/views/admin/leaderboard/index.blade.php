@extends('layouts.admin')

@section('title', 'Top Students')

@section('content')
<div class="page-header" style="text-align: center; margin-bottom: 3.5rem; animation: fadeIn 0.5s ease-out;">
    <div style="width: 64px; height: 64px; background: #fffbeb; border-radius: 50%; color: #fbbf24; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem auto; border: 2px solid #fef3c7; box-shadow: 0 4px 6px -1px rgba(251, 191, 36, 0.1);">
        <i data-lucide="trophy" style="width: 32px; height: 32px;"></i>
    </div>
    <h1 style="font-size: 2.5rem; font-weight: 900; color: var(--text-main); margin: 0 0 0.5rem 0; letter-spacing: -0.025em;">Top Students</h1>
    <p style="color: var(--text-secondary); margin: 0 auto; font-size: 1.125rem; max-width: 600px;">Merayakan prestasi siswa terbaik berdasarkan akumulasi skor belajar mereka</p>
</div>

<!-- Top Three Podium -->
@if($students->count() > 0)
<div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 2rem; margin-bottom: 4rem; max-width: 1000px; margin-left: auto; margin-right: auto; align-items: flex-end;">
    <!-- 2nd Place -->
    @if($students->count() >= 2)
    <div class="stat-card" style="background: white; padding: 2.5rem 1.5rem; border-radius: 1.5rem; text-align: center; order: 1; border: 1px solid var(--border-color); animation: slideUp 0.6s ease-out 0.1s both;">
        <div style="position: relative; display: inline-block; margin-bottom: 1.5rem;">
            <div style="width: 80px; height: 80px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; border: 4px solid #cbd5e1; color: #64748b; font-weight: 800;">
                {{ substr($students[1]->name, 0, 1) }}
            </div>
            <div style="position: absolute; bottom: -5px; right: -5px; width: 32px; height: 32px; background: #94a3b8; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.875rem; border: 3px solid white;">2</div>
        </div>
        <div style="font-weight: 700; color: var(--text-main); font-size: 1.125rem; margin-bottom: 0.25rem;">{{ $students[1]->name }}</div>
        <div style="font-size: 0.875rem; color: var(--text-secondary); margin-bottom: 1rem;">Kelas: {{ $students[1]->class ?? '-' }}</div>
        <div style="font-size: 1.5rem; font-weight: 800; color: #94a3b8;">{{ number_format($students[1]->score) }} pts</div>
    </div>
    @endif

    <!-- 1st Place -->
    <div class="stat-card" style="background: white; padding: 3.5rem 1.5rem; border-radius: 1.5rem; text-align: center; order: 2; border: 2px solid #fbbf24; box-shadow: 0 20px 25px -5px rgba(251, 191, 36, 0.1); transform: scale(1.05); z-index: 10; animation: slideUp 0.6s ease-out both;">
        <div style="position: relative; display: inline-block; margin-bottom: 1.5rem;">
            <div style="width: 100px; height: 100px; border-radius: 50%; background: #fff7ed; display: flex; align-items: center; justify-content: center; font-size: 3rem; border: 5px solid #fbbf24; color: #fbbf24; font-weight: 800; box-shadow: 0 0 20px rgba(251, 191, 36, 0.2);">
                {{ substr($students[0]->name, 0, 1) }}
            </div>
            <div style="position: absolute; bottom: -5px; right: -5px; width: 38px; height: 38px; background: #fbbf24; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.125rem; border: 4px solid white;">1</div>
            <div style="position: absolute; top: -20px; left: 50%; transform: translateX(-50%); color: #fbbf24;">
                <i data-lucide="crown" style="width: 32px; height: 32px;"></i>
            </div>
        </div>
        <div style="font-weight: 800; color: var(--text-main); font-size: 1.375rem; margin-bottom: 0.25rem;">{{ $students[0]->name }}</div>
        <div style="font-size: 0.875rem; color: var(--text-secondary); margin-bottom: 1.25rem;">Kelas: {{ $students[0]->class ?? '-' }}</div>
        <div style="font-size: 2rem; font-weight: 900; color: #fbbf24; text-shadow: 0 2px 4px rgba(251, 191, 36, 0.1);">{{ number_format($students[0]->score) }} pts</div>
    </div>

    <!-- 3rd Place -->
    @if($students->count() >= 3)
    <div class="stat-card" style="background: white; padding: 2.5rem 1.5rem; border-radius: 1.5rem; text-align: center; order: 3; border: 1px solid var(--border-color); animation: slideUp 0.6s ease-out 0.2s both;">
        <div style="position: relative; display: inline-block; margin-bottom: 1.5rem;">
            <div style="width: 80px; height: 80px; border-radius: 50%; background: #fff7ed; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; border: 4px solid #d97706; color: #d97706; font-weight: 800;">
                {{ substr($students[2]->name, 0, 1) }}
            </div>
            <div style="position: absolute; bottom: -5px; right: -5px; width: 32px; height: 32px; background: #d97706; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.875rem; border: 3px solid white;">3</div>
        </div>
        <div style="font-weight: 700; color: var(--text-main); font-size: 1.125rem; margin-bottom: 0.25rem;">{{ $students[2]->name }}</div>
        <div style="font-size: 0.875rem; color: var(--text-secondary); margin-bottom: 1rem;">Kelas: {{ $students[2]->class ?? '-' }}</div>
        <div style="font-size: 1.5rem; font-weight: 800; color: #d97706;">{{ number_format($students[2]->score) }} pts</div>
    </div>
    @endif
</div>
@endif

<!-- Full Leaderboard Table -->
<div class="card" style="border-radius: 1.5rem; overflow: hidden; border: 1px solid var(--border-color); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); max-width: 1000px; margin: 0 auto;">
    <div style="padding: 1.5rem 2rem; border-bottom: 1px solid var(--border-color); background: white;">
        <div class="search-box">
            <i data-lucide="search"></i>
            <input type="text" id="leaderboard-search" onkeyup="filterBySearch()" placeholder="Cari nama siswa...">
        </div>
    </div>
    <div class="table-container">
        <table id="leaderboard-table" style="border-collapse: separate; border-spacing: 0;">
            <thead>
                <tr>
                    <th style="padding: 1.25rem 2rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase; width: 80px; text-align: center;">RANK</th>
                    <th style="padding: 1.25rem 2rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">SISWA</th>
                    <th style="padding: 1.25rem 2rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">KELAS</th>
                    <th style="padding: 1.25rem 2rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase;">SCORE MATERI</th>
                    <th style="padding: 1.25rem 2rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; font-size: 0.75rem; font-weight: 700; color: var(--text-secondary); text-transform: uppercase; text-align: right;">TOTAL SCORE</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $index => $student)
                    <tr class="leaderboard-row" style="{{ $index < 3 ? 'background: #fbfdfe' : '' }}">
                        <td style="padding: 1.25rem 2rem; text-align: center;">
                            @php $rank = (($students->currentPage() - 1) * $students->perPage()) + $index + 1; @endphp
                            @if($rank == 1) <span style="font-weight: 900; color: #fbbf24; font-size: 1.125rem;">#1</span>
                            @elseif($rank == 2) <span style="font-weight: 800; color: #94a3b8; font-size: 1.05rem;">#2</span>
                            @elseif($rank == 3) <span style="font-weight: 800; color: #d97706; font-size: 1.05rem;">#3</span>
                            @else <span style="font-weight: 600; color: var(--text-secondary);">{{ $rank }}</span>
                            @endif
                        </td>
                        <td style="padding: 1.25rem 2rem;">
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 36px; height: 36px; border-radius: 50%; background: #f1f5f9; color: var(--text-main); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8125rem; border: 1.5px solid white; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                                    {{ substr($student->name, 0, 1) }}
                                </div>
                                <span style="font-weight: 700; color: var(--text-main);" class="student-name">{{ $student->name }}</span>
                            </div>
                        </td>
                        <td style="padding: 1.25rem 2rem; color: var(--text-secondary); font-size: 0.875rem;">
                            {{ $student->class ?? '-' }}
                        </td>
                        <td style="padding: 1.25rem 2rem; color: var(--text-secondary); font-size: 0.875rem;">
                            <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                                <span>Learn: {{ $student->total_words_learned }} words</span>
                                <span>Done: {{ $student->exersises_completed }} exercises</span>
                            </div>
                        </td>
                        <td style="padding: 1.25rem 2rem; text-align: right;">
                            <span style="font-weight: 800; color: var(--primary); font-size: 1.125rem;">{{ number_format($student->score) }}</span>
                            <span style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 600; margin-left: 0.25rem;">PTS</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 1.5rem; max-width: 1000px; margin-left: auto; margin-right: auto;">
    {{ $students->links() }}
</div>

@endsection

@push('styles')
<style>
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .leaderboard-row:hover td {
        background-color: #f7f9fc;
    }
    
    table td {
        transition: background-color 0.2s;
    }
</style>
@endpush

@push('scripts')
<script>
    function filterBySearch() {
        const searchQuery = document.getElementById('leaderboard-search').value.toLowerCase();
        const rows = document.querySelectorAll('.leaderboard-row');

        rows.forEach(row => {
            const name = row.querySelector('.student-name').innerText.toLowerCase();
            if (name.includes(searchQuery)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
@endpush
