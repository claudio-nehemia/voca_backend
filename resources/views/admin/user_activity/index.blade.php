@extends('layouts.admin')

@section('title', 'User Activity')

@section('content')
<div class="page-header" style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2.5rem; animation: fadeIn 0.5s ease-out;">
    <div>
        <h1 style="font-size: 2.25rem; font-weight: 800; color: var(--text-main); margin: 0 0 0.5rem 0; letter-spacing: -0.025em;">User Activity</h1>
        <p style="color: var(--text-secondary); margin: 0; font-size: 1rem;">Pantau progres dan aktivitas belajar pengguna aplikasi mobile</p>
    </div>
</div>

<!-- Tabs / Filters -->
<div class="card" style="padding: 1.25rem; margin-bottom: 2rem; border-radius: 1.25rem; background: linear-gradient(to right, white, #f8fafc);">
    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1.5rem;">
        <div style="display: flex; gap: 0.625rem; flex-wrap: wrap;">
            <a href="{{ route('user-activity.index', ['view' => 'user']) }}" class="filter-pill {{ $viewType === 'user' ? 'active' : '' }}" style="text-decoration: none;">Berdasarkan User</a>
            <a href="{{ route('user-activity.index', ['view' => 'activity']) }}" class="filter-pill {{ $viewType === 'activity' ? 'active' : '' }}" style="text-decoration: none;">Berdasarkan Aktivitas</a>
        </div>
        
        @if($viewType === 'user')
        <div style="display: flex; align-items: center; gap: 1rem;">
            <div style="color: var(--text-main); font-size: 0.9375rem; font-weight: 600;">Pilih User:</div>
            <form action="{{ route('user-activity.index') }}" method="GET" style="margin: 0;">
                <input type="hidden" name="view" value="user">
                <select name="user_id" onchange="this.form.submit()" style="padding: 0.5rem 1rem; border-radius: 0.875rem; border: 1px solid var(--border-color); outline: none;">
                    <option value="">-- Pilih User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $selectedUserId == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->score }} pts)</option>
                    @endforeach
                </select>
            </form>
        </div>
        @else
        <div style="display: flex; align-items: center; gap: 1rem;">
            <div style="color: var(--text-main); font-size: 0.9375rem; font-weight: 600;">Pilih Aktivitas:</div>
            <form action="{{ route('user-activity.index') }}" method="GET" style="margin: 0;">
                <input type="hidden" name="view" value="activity">
                <select name="activity" onchange="this.form.submit()" style="padding: 0.5rem 1rem; border-radius: 0.875rem; border: 1px solid var(--border-color); outline: none;">
                    <option value="writing" {{ request('activity', 'writing') == 'writing' ? 'selected' : '' }}>Writing (Hasil Jawaban)</option>
                    <option value="speaking" {{ request('activity') == 'speaking' ? 'selected' : '' }}>Speaking (Rekaman Suara)</option>
                    <option value="vocab" {{ request('activity') == 'vocab' ? 'selected' : '' }}>Vocabulary (Progres)</option>
                </select>
            </form>
        </div>
        @endif
    </div>
</div>

@if($viewType === 'user')
    @if(!$selectedUserId)
        <div class="card" style="text-align: center; padding: 5rem 2rem; border-radius: 1.25rem;">
            <div style="color: #cbd5e1; margin-bottom: 1rem;">
                <i data-lucide="user-search" style="width: 48px; height: 48px;"></i>
            </div>
            <div style="font-weight: 600; color: var(--text-secondary);">Silakan pilih user terlebih dahulu untuk melihat aktivitasnya.</div>
        </div>
    @else
        <!-- User Detail Profile Summary -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            <div class="card" style="padding: 1.5rem; border-radius: 1.25rem; display: flex; align-items: center; gap: 1.25rem;">
                <div style="width: 60px; height: 60px; border-radius: 50%; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 800;">
                    {{ substr($data['user']->name, 0, 1) }}
                </div>
                <div>
                    <h2 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.25rem;">{{ $data['user']->name }}</h2>
                    <p style="color: var(--text-secondary); margin: 0; font-size: 0.875rem;">{{ $data['user']->email }}</p>
                </div>
            </div>
            <div class="card" style="padding: 1.5rem; border-radius: 1.25rem; display: flex; align-items: center; gap: 1.25rem;">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: #fff7ed; color: #f97316; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="star" style="width: 24px; height: 24px; fill: currentColor;"></i>
                </div>
                <div>
                    <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase; font-weight: 600;">Total Score</div>
                    <div style="font-size: 1.5rem; font-weight: 700; color: var(--text-main);">{{ $data['user']->score }}</div>
                </div>
            </div>
            <div class="card" style="padding: 1.5rem; border-radius: 1.25rem; display: flex; align-items: center; gap: 1.25rem;">
                <div style="width: 48px; height: 48px; border-radius: 12px; background: #f0fdf4; color: #22c55e; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="check-circle" style="width: 24px; height: 24px;"></i>
                </div>
                <div>
                    <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase; font-weight: 600;">Words Learned</div>
                    <div style="font-size: 1.5rem; font-weight: 700; color: var(--text-main);">{{ $data['user']->total_words_learned }}</div>
                </div>
            </div>
        </div>

        <!-- Progress Lists -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 2rem;">
            <!-- Writing Activity -->
            <div class="card" style="padding: 0; border-radius: 1.25rem; overflow: hidden;">
                <div style="padding: 1.25rem 1.75rem; border-bottom: 1px solid var(--border-color); background: #f8fafc; font-weight: 700; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <i data-lucide="pen-tool" style="width: 18px; height: 18px; color: #6366f1;"></i>
                        Writing Exercises
                    </div>
                    <a href="{{ route('user-activity.writing', $data['user']->id) }}" style="font-size: 0.75rem; color: var(--primary); text-decoration: none; font-weight: 600;">Lihat Semua &rarr;</a>
                </div>
                <div style="padding: 1.5rem; max-height: 500px; overflow: auto;">
                    @forelse($data['writing'] as $w)
                        <div style="margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px dashed #e2e8f0; last-child: border-bottom: 0;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                                <div style="font-weight: 600; font-size: 1rem; color: var(--text-main);">{{ $w->title }}</div>
                                <div style="font-size: 0.75rem; color: var(--text-secondary);">{{ \Carbon\Carbon::parse($w->submitted_at)->format('d M Y H:i') }}</div>
                            </div>
                            <div style="background: #f1f5f9; padding: 1rem; border-radius: 0.75rem; font-size: 0.9375rem; line-height: 1.6; color: #334155; position: relative;">
                                <div style="position: absolute; top: -10px; right: 10px; background: #6366f1; color: white; padding: 2px 8px; border-radius: 6px; font-size: 0.625rem; font-weight: 800;">{{ $w->point_earned }} pts</div>
                                "{{ $w->answer }}"
                            </div>
                        </div>
                    @empty
                        <p style="text-align: center; color: var(--text-secondary); margin: 2rem 0;">Belum ada hasil writing.</p>
                    @endforelse
                </div>
            </div>

            <!-- Speaking Activity -->
            <div class="card" style="padding: 0; border-radius: 1.25rem; overflow: hidden;">
                <div style="padding: 1.25rem 1.75rem; border-bottom: 1px solid var(--border-color); background: #f8fafc; font-weight: 700; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <i data-lucide="mic" style="width: 18px; height: 18px; color: #f97316;"></i>
                        Speaking Exercises
                    </div>
                    <a href="{{ route('user-activity.speaking', $data['user']->id) }}" style="font-size: 0.75rem; color: var(--primary); text-decoration: none; font-weight: 600;">Lihat Semua &rarr;</a>
                </div>
                <div style="padding: 1.5rem; max-height: 500px; overflow: auto;">
                    @forelse($data['speaking'] as $s)
                        <div style="margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 1px dashed #e2e8f0; last-child: border-bottom: 0;">
                            <div style="display: flex; justify-content: space-between; align-items: center, margin-bottom: 0.75rem;">
                                <div style="font-weight: 600; font-size: 1rem; color: var(--text-main);">{{ $s->title }}</div>
                                <div style="font-size: 0.75rem; color: var(--text-secondary);">{{ \Carbon\Carbon::parse($s->submitted_at)->format('d M Y H:i') }}</div>
                            </div>
                            <div style="margin-top: 0.5rem;">
                                <audio controls style="width: 100%; height: 32px;">
                                    <source src="{{ asset('storage/' . $s->audio_url) }}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                        </div>
                    @empty
                        <p style="text-align: center; color: var(--text-secondary); margin: 2rem 0;">Belum ada hasil speaking.</p>
                    @endforelse
                </div>
            </div>

            <!-- Vocab Activity -->
            <div class="card" style="padding: 0; border-radius: 1.25rem; overflow: hidden;">
                <div style="padding: 1.25rem 1.75rem; border-bottom: 1px solid var(--border-color); background: #f8fafc; font-weight: 700; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <i data-lucide="book-open" style="width: 18px; height: 18px; color: var(--primary);"></i>
                        Vocabulary Progress
                    </div>
                    <a href="{{ route('user-activity.vocab', $data['user']->id) }}" style="font-size: 0.75rem; color: var(--primary); text-decoration: none; font-weight: 600;">Lihat Semua &rarr;</a>
                </div>
                <div style="padding: 1.5rem; max-height: 500px; overflow: auto;">
                    @forelse($data['vocab'] as $v)
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem; padding: 0.75rem; background: #fdfdfd; border: 1px solid #f1f5f9; border-radius: 0.75rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 24px; height: 24px; border-radius: 50%; background: #dcfce7; color: #22c55e; display: flex; align-items: center; justify-content: center;">
                                    <i data-lucide="check" style="width: 14px; height: 14px;"></i>
                                </div>
                                <div style="font-weight: 600; color: var(--text-main);">{{ $v->title }}</div>
                            </div>
                            <div style="font-size: 0.75rem; color: var(--text-secondary);">{{ \Carbon\Carbon::parse($v->completed_at)->format('d M Y') }}</div>
                        </div>
                    @empty
                        <p style="text-align: center; color: var(--text-secondary); margin: 2rem 0;">Belum ada progres kosakata.</p>
                    @endforelse
                </div>
            </div>
        </div>
    @endif

@else <!-- View by Activity -->
    <div class="card" style="border-radius: 1.25rem; overflow: hidden; border: 1px solid var(--border-color);">
        <div class="table-container">
            <table style="border-collapse: separate; border-spacing: 0;">
                <thead>
                    <tr>
                        <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc;">USER</th>
                        <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc;">AKTIVITAS / TITLE</th>
                        @if($data['selected_activity'] === 'writing')
                            <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc;">HASIL JAWABAN</th>
                        @elseif($data['selected_activity'] === 'speaking')
                            <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc;">AUDIO JAWABAN</th>
                        @endif
                        <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc;">WAKTU</th>
                        <th style="padding: 1.25rem 1.5rem; border-bottom: 2px solid #f1f5f9; background: #f8fafc; text-align: center;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data['activities'] as $act)
                        <tr>
                            <td style="padding: 1.25rem 1.5rem;">
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div style="width: 32px; height: 32px; border-radius: 50%; background: #eee; display: flex; align-items: center; justify-content: center; font-weight: 700;">{{ substr($act->user_name, 0, 1) }}</div>
                                    <span style="font-weight: 600; color: var(--text-main);">{{ $act->user_name }}</span>
                                </div>
                            </td>
                            <td style="padding: 1.25rem 1.5rem;">
                                <span style="font-weight: 600;">{{ $act->activity_title }}</span>
                            </td>
                            @if($data['selected_activity'] === 'writing')
                            <td style="padding: 1.25rem 1.5rem; color: var(--text-secondary); max-width: 300px;">
                                <div style="background: #f8fafc; padding: 0.5rem 0.75rem; border-radius: 0.5rem; font-style: italic;">"{{ Str::limit($act->answer, 120) }}"</div>
                            </td>
                            @elseif($data['selected_activity'] === 'speaking')
                            <td style="padding: 1.25rem 1.5rem;">
                                <audio controls style="width: 200px; height: 30px;">
                                    <source src="{{ asset('storage/' . $act->audio_url) }}" type="audio/mpeg">
                                </audio>
                            </td>
                            @endif
                            <td style="padding: 1.25rem 1.5rem; font-size: 0.8125rem; color: var(--text-secondary);">
                                {{ \Carbon\Carbon::parse($act->created_at)->diffForHumans() }}
                            </td>
                            <td style="padding: 1.25rem 1.5rem;">
                                <div style="display: flex; justify-content: center;">
                                    <a href="{{ route('user-activity.index', ['view' => 'user', 'user_id' => $act->user_id]) }}" title="Lihat Profil User" style="color: var(--primary);">
                                        <i data-lucide="user"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 5rem 2rem; color: var(--text-secondary);">Tidak ada aktivitas baru hari ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div style="margin-top: 1.5rem;">
        {{ $data['activities']->appends(request()->query())->links() }}
    </div>
@endif

@endsection

@push('styles')
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .filter-pill {
        padding: 0.5rem 1.25rem;
        border-radius: 0.875rem;
        background-color: white;
        border: 1px solid var(--border-color);
        color: var(--text-secondary);
        font-size: 0.8125rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    .filter-pill:hover {
        background-color: #f8fafc;
        border-color: #cbd5e1;
        color: var(--text-main);
    }
    .filter-pill.active {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
        box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
    }
    
    table tr:hover td {
        background-color: #fcfdfe;
    }
</style>
@endpush
