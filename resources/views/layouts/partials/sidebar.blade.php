<div class="sidebar">
    <div style="padding: 0 2rem; margin-bottom: 2rem;">
        <h1 style="font-size: 1.25rem; font-weight: 700; color: var(--primary); margin: 0;">Voca Mate</h1>
    </div>

    <div style="flex: 1; padding: 0 1rem;">
        <div style="color: var(--text-secondary); font-size: 0.75rem; text-transform: uppercase; font-weight: 600; padding: 0 1rem; margin-bottom: 0.75rem;">Utama</div>
        <a href="#" class="sidebar-item" style="display: flex; align-items: center; padding: 0.75rem 1rem; border-radius: 0.5rem; text-decoration: none; color: var(--text-secondary); margin-bottom: 0.25rem;">
            <i data-lucide="layout-dashboard" style="width: 18px; height: 18px; margin-right: 0.75rem;"></i>
            Dashboard
        </a>

        <div style="color: var(--text-secondary); font-size: 0.75rem; text-transform: uppercase; font-weight: 600; padding: 0 1rem; margin-top: 1.5rem; margin-bottom: 0.75rem;">Konten</div>
        <a href="{{ route('vocabularies.index') }}" class="sidebar-item {{ request()->routeIs('vocabularies.*') ? 'active' : '' }}" style="display: flex; align-items: center; padding: 0.75rem 1rem; border-radius: 0.5rem; text-decoration: none; color: var(--text-secondary); margin-bottom: 0.25rem;">
            <i data-lucide="book-open" style="width: 18px; height: 18px; margin-right: 0.75rem;"></i>
            Vocabulary
        </a>
        <a href="{{ route('writings.index') }}" class="sidebar-item {{ request()->routeIs('writings.*') ? 'active' : '' }}" style="display: flex; align-items: center; padding: 0.75rem 1rem; border-radius: 0.5rem; text-decoration: none; color: var(--text-secondary); margin-bottom: 0.25rem;">
            <i data-lucide="pen-tool" style="width: 18px; height: 18px; margin-right: 0.75rem;"></i>
            Writing
        </a>
        <a href="{{ route('speakings.index') }}" class="sidebar-item {{ request()->routeIs('speakings.*') ? 'active' : '' }}" style="display: flex; align-items: center; padding: 0.75rem 1rem; border-radius: 0.5rem; text-decoration: none; color: var(--text-secondary); margin-bottom: 0.25rem;">
            <i data-lucide="mic" style="width: 18px; height: 18px; margin-right: 0.75rem;"></i>
            Speaking
        </a>
        <a href="{{ route('materials.index') }}" class="sidebar-item {{ request()->routeIs('materials.*') ? 'active' : '' }}" style="display: flex; align-items: center; padding: 0.75rem 1rem; border-radius: 0.5rem; text-decoration: none; color: var(--text-secondary); margin-bottom: 0.25rem;">
            <i data-lucide="layers" style="width: 18px; height: 18px; margin-right: 0.75rem;"></i>
            Materials
        </a>
        <a href="{{ route('achievements.index') }}" class="sidebar-item {{ request()->routeIs('achievements.*') ? 'active' : '' }}" style="display: flex; align-items: center; padding: 0.75rem 1rem; border-radius: 0.5rem; text-decoration: none; color: var(--text-secondary); margin-bottom: 0.25rem;">
            <i data-lucide="award" style="width: 18px; height: 18px; margin-right: 0.75rem;"></i>
            Achievements
        </a>

        <div style="color: var(--text-secondary); font-size: 0.75rem; text-transform: uppercase; font-weight: 600; padding: 0 1rem; margin-top: 1.5rem; margin-bottom: 0.75rem;">Manajemen User</div>
        <a href="{{ route('admin-users.index') }}" class="sidebar-item {{ request()->routeIs('admin-users.*') ? 'active' : '' }}" style="display: flex; align-items: center; padding: 0.75rem 1rem; border-radius: 0.5rem; text-decoration: none; color: var(--text-secondary); margin-bottom: 0.25rem;">
            <i data-lucide="users" style="width: 18px; height: 18px; margin-right: 0.75rem;"></i>
            Admin Users
        </a>
        <a href="{{ route('mobile-users.index') }}" class="sidebar-item {{ request()->routeIs('mobile-users.*') ? 'active' : '' }}" style="display: flex; align-items: center; padding: 0.75rem 1rem; border-radius: 0.5rem; text-decoration: none; color: var(--text-secondary); margin-bottom: 0.25rem;">
            <i data-lucide="user-plus" style="width: 18px; height: 18px; margin-right: 0.75rem;"></i>
            Mobile Users
        </a>
        <a href="{{ route('top-students.index') }}" class="sidebar-item {{ request()->routeIs('top-students.*') ? 'active' : '' }}" style="display: flex; align-items: center; padding: 0.75rem 1rem; border-radius: 0.5rem; text-decoration: none; color: var(--text-secondary); margin-bottom: 0.25rem;">
            <i data-lucide="trophy" style="width: 18px; height: 18px; margin-right: 0.75rem;"></i>
            Top Students
        </a>
        <a href="{{ route('user-activity.index') }}" class="sidebar-item {{ request()->routeIs('user-activity.*') ? 'active' : '' }}" style="display: flex; align-items: center; padding: 0.75rem 1rem; border-radius: 0.5rem; text-decoration: none; color: var(--text-secondary); margin-bottom: 0.25rem;">
            <i data-lucide="activity" style="width: 18px; height: 18px; margin-right: 0.75rem;"></i>
            User Activity
        </a>

    </div>

    <div style="padding: 1.5rem; border-top: 1px solid var(--border-color); display: flex; flex-direction: column; gap: 1rem;">
        <div style="display: flex; align-items: center; gap: 0.75rem;">
            <div style="width: 32px; height: 32px; border-radius: 6px; background-color: var(--sidebar-active-bg); color: var(--primary); display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.75rem;">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div>
                <div style="font-weight: 600; font-size: 0.8125rem;">{{ Auth::user()->name }}</div>
                <div style="font-size: 0.75rem; color: var(--text-secondary);">{{ Auth::user()->email }}</div>
            </div>
        </div>
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn" style="width: 100%; border: 1px solid var(--border-color); background: white; color: #ef4444; font-size: 0.75rem; justify-content: flex-start;">
                <i data-lucide="log-out" style="width: 16px; height: 16px;"></i>
                Keluar
            </button>
        </form>
    </div>
</div>

<style>
    .sidebar-item:hover {
        background-color: var(--bg-main);
        color: var(--text-main) !important;
    }
    .sidebar-item.active {
        background-color: var(--sidebar-active-bg) !important;
        color: var(--primary) !important;
        font-weight: 600;
    }
    .main-content {
        margin-left: 260px;
    }
</style>
