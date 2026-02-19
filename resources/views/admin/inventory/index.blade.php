<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-6 space-y-12">

            <!-- Header -->
            <div class="flex justify-between items-center relative">
                <div class="relative">
                    <h1 class="text-6xl font-black text-white tracking-tighter italic uppercase drop-shadow-[0_0_15px_rgba(255,255,255,0.1)]">Stock <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-pink-500 to-purple-400">Técnico</span></h1>
                    <p class="text-slate-300 mt-4 font-black uppercase tracking-[0.4em] text-sm italic">Hardware Asset Library • Mission Control</p>
                    <div class="absolute -left-8 top-1/2 -translate-y-1/2 w-2 h-20 bg-gradient-to-b from-purple-500 to-pink-600 rounded-full shadow-[0_0_25px_rgba(168,85,247,0.7)]"></div>
                </div>
                <a href="{{ route('admin.inventory.create') }}" class="px-12 py-5 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-[2.5rem] font-black text-sm shadow-2xl shadow-purple-600/40 hover:scale-105 transition-all flex items-center gap-4 uppercase tracking-[0.3em] group">
                    <svg class="w-6 h-6 group-hover:rotate-90 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Nuevo Activo
                </a>
            </div>

            <!-- Inventory Catalog -->
            <div class="grid grid-cols-1 gap-6">
                @forelse($equipos as $equipo)
                    <div class="glass-card rounded-[2.5rem] border-white/10 p-8 transition-all hover:border-purple-500/30 group relative overflow-hidden shadow-2xl hover:shadow-purple-500/10">
                        <div class="flex items-center gap-8 relative z-10">

                            <!-- Equipo Image -->
                            <div class="w-40 h-40 bg-white/5 rounded-[2.5rem] overflow-hidden flex-shrink-0 border border-white/20 p-1.5 group-hover:border-purple-500/50 transition-colors shadow-2xl">
                                <div class="w-full h-full rounded-[2.2rem] overflow-hidden bg-slate-950 border border-white/5 relative">
                                    @if(isset($equipo->imagen_url))
                                        <img src="{{ $equipo->imagen_url }}" class="w-full h-full object-cover group-hover:scale-125 transition-transform duration-1000" alt="{{ $equipo->nombre }}">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-800 bg-white/5">
                                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Equipo Info -->
                            <div class="flex-1 grid grid-cols-12 gap-8 items-center">
                                <div class="col-span-4 space-y-3">
                                    <h3 class="text-4xl font-black text-white leading-none tracking-tighter uppercase group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-purple-400 group-hover:to-pink-500 transition-all duration-500">{{ $equipo->nombre }}</h3>
                                    <span class="text-[10px] font-black text-purple-400 bg-purple-500/10 px-4 py-2 rounded-xl mt-4 inline-block uppercase tracking-[0.3em] border border-purple-500/20 shadow-xl">{{ $equipo->tipo }}</span>
                                </div>

                                <div class="col-span-3">
                                    <div class="space-y-3">
                                        <span class="text-[10px] font-black text-slate-400 block tracking-[0.4em] uppercase">Hardware Load Out</span>
                                        <div class="flex items-end gap-3">
                                            <span class="text-6xl font-black text-white mt-2 leading-none tracking-tighter drop-shadow-[0_0_15px_rgba(255,255,255,0.1)]">{{ $equipo->cantidad_disponible }}</span>
                                            <span class="text-lg font-black text-slate-500 mb-2 uppercase tracking-widest leading-none">/ {{ $equipo->cantidad_total }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-3">
                                    <span class="text-[10px] font-black text-slate-400 block mb-5 tracking-[0.4em] uppercase">System Status</span>
                                    <span class="px-8 py-3 rounded-[1.5rem] text-xs font-black uppercase tracking-[0.3em] border backdrop-blur-md shadow-2xl {{ $stateStyles[$equipo->estado] ?? 'bg-white/5 text-white border-white/10' }}">
                                        {{ $equipo->estado }}
                                    </span>
                                </div>

                                <div class="col-span-2 flex justify-end gap-3">
                                    <a href="{{ route('admin.inventory.edit', $equipo) }}" class="p-4 bg-white/5 text-slate-400 rounded-2xl hover:bg-purple-600 hover:text-white transition-all shadow-xl hover:shadow-purple-600/30 border border-white/5">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.inventory.destroy', $equipo) }}" method="POST" onsubmit="return confirm('¿Retirar este activo permanentemente?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-4 bg-white/5 text-rose-400 rounded-2xl hover:bg-rose-600 hover:text-white transition-all shadow-xl hover:shadow-rose-600/30 border border-white/5">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="glass-card rounded-[2.5rem] border-white/10 p-24 text-center">
                        <p class="text-slate-400 font-black uppercase tracking-widest">No hay equipos registrados en el inventario.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($equipos->hasPages())
                <div class="mt-8">
                    {{ $equipos->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
