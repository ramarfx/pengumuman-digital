<div class="flex-shrink-0 bg-white">
  <div class="p-4">
    <h2 class="mb-4 text-2xl font-bold">Dashboard</h2>
    <ul class="space-y-2">
      <li><a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2 hover:text-primary"><i
            class="fa-solid fa-table-columns"></i>
          Dashboard</a></li>
      <li><a href="{{ route('post.index') }}" class="flex items-center gap-3 px-4 py-2 hover:text-primary"><i
            class="fa-regular fa-file"></i>
          postingan mu</a>
      </li>
      @if (auth()->user()->roles->contains('name', 'admin'))
        <li><a href="{{ route('users.index') }}" class="flex items-center gap-3 px-4 py-2 hover:text-primary"><i
              class="fa-regular fa-user"></i>
            List User</a>
        </li>
        <li><a href="{{ route('post.index') }}" class="flex items-center gap-3 px-4 py-2 hover:text-primary"><i
              class="fa-regular fa-square-check"></i> submit post</a></li>
      @endif
    </ul>

    <a href="{{ route('post.create') }}"
      class="mt-5 flex items-center gap-3 rounded-xl border border-primary border-opacity-50 bg-primary bg-opacity-20 px-4 py-2 text-primary">
      <i class="fa-solid fa-plus"></i> Tambah post
    </a>
  </div>
</div>
