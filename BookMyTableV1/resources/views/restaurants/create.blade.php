<x-app-layout>
    <style>
        [x-cloak] { display: none !important; }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            75% { transform: translateX(8px); }
        }
        .animate-shake { animation: shake 0.3s ease-in-out; }
        input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
    </style>

    <div class="min-h-screen bg-[#050505] py-12 px-4" 
         x-data="restaurantForm()" x-cloak>

        <div class="max-w-3xl mx-auto mb-16">
            <div class="flex justify-between items-center relative">
                <div class="absolute inset-0 top-5 h-0.5 bg-white/5 -z-10"></div>
                <div class="absolute inset-0 top-5 h-0.5 bg-[#FF5F00] transition-all duration-700 -z-10" 
                     :style="'width: ' + ((step-1)/3 * 100) + '%'"></div>

                <template x-for="i in 4">
                    <div class="flex flex-col items-center gap-3">
                        <div :class="step >= i ? 'bg-[#FF5F00] border-[#FF5F00] shadow-[0_0_20px_rgba(255,95,0,0.4)] scale-110' : 'bg-[#050505] border-white/10 text-gray-500'" 
                             class="w-12 h-12 rounded-2xl border-2 flex items-center justify-center font-black transition-all duration-500"
                             x-text="i"></div>
                        <span class="text-[9px] font-black uppercase tracking-tighter"
                              :class="step >= i ? 'text-[#FF5F00]' : 'text-gray-600'"
                              x-text="getStepTitle(i)"></span>
                    </div>
                </template>
            </div>
        </div>

        <form action="{{ route('restaurants.store') }}" method="POST" enctype="multipart/form-data" 
              class="max-w-4xl mx-auto" id="mainForm">
            @csrf

            <div x-show="step === 1" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4">
                <div class="bg-[#0A0A0A] border border-white/5 p-10 rounded-[2.5rem] shadow-2xl">
                    <div class="mb-10 text-center">
                        <h2 class="text-4xl font-black italic text-white uppercase tracking-tighter">Identité<span class="text-[#FF5F00]">.</span></h2>
                        <p class="text-gray-500 text-[10px] uppercase mt-2 tracking-[3px]">Détails principaux du restaurant</p>
                    </div>

                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-[10px] text-gray-400 font-black uppercase tracking-widest ml-1">Nom du Restaurant *</label>
                            <input type="text" name="nom_restaurant" required 
                                   class="w-full bg-[#111] border border-white/5 rounded-2xl px-6 py-5 text-white focus:border-[#FF5F00] transition-all outline-none">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] text-gray-400 font-black uppercase tracking-widest ml-1">Ville *</label>
                                <input type="text" name="adresse_restaurant" required 
                                       class="w-full bg-[#111] border border-white/5 rounded-2xl px-6 py-5 text-white focus:border-[#FF5F00] outline-none">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] text-gray-400 font-black uppercase tracking-widest ml-1">Cuisine *</label>
                                <select name="type_cuisine_id" required 
                                        class="w-full bg-[#111] border border-white/5 rounded-2xl px-6 py-5 text-white focus:border-[#FF5F00] outline-none cursor-pointer">
                                    <option value="" disabled selected>Genre</option>
                                    @foreach ($type_cuisines as $type)
                                        <option value="{{ $type->id }}">{{ $type->nom_type_cuisine }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] text-gray-400 font-black uppercase tracking-widest ml-1">Capacité *</label>
                                <input type="number" name="capacity" required placeholder="Ex: 50"
                                       class="w-full bg-[#111] border border-white/5 rounded-2xl px-6 py-5 text-white focus:border-[#FF5F00] outline-none">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] text-gray-400 font-black uppercase tracking-widest ml-1">Description du restaurant *</label>
                            <textarea name="description_restaurant" rows="4" required 
                                      placeholder="Racontez l'histoire de votre restaurant, votre concept..."
                                      class="w-full bg-[#111] border border-white/5 rounded-2xl px-6 py-5 text-sm text-white focus:border-[#FF5F00] transition-all outline-none resize-none"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="step === 2" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4">
                <div class="bg-[#0A0A0A] border border-white/5 p-10 rounded-[2.5rem]">
                    <h2 class="text-3xl font-black italic text-white mb-10 uppercase text-center">Logistique & Plannings<span class="text-[#FF5F00]">.</span></h2>
                    
                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="space-y-2">
                            <label class="text-[10px] text-gray-400 font-black uppercase tracking-widest ml-1">Email *</label>
                            <input type="email" name="email_restaurant" required class="w-full bg-[#111] border border-white/5 rounded-2xl px-6 py-4 text-white focus:border-[#FF5F00] outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] text-gray-400 font-black uppercase tracking-widest ml-1">Téléphone *</label>
                            <input type="text" name="telephone_restaurant" required class="w-full bg-[#111] border border-white/5 rounded-2xl px-6 py-4 text-white focus:border-[#FF5F00] outline-none">
                        </div>
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] text-gray-400 font-black uppercase ml-1 tracking-widest">Horaires d'ouverture *</label>
                        @foreach (['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'] as $day)
                            <div class="flex items-center gap-4 p-4 bg-white/[0.02] rounded-2xl border border-white/5 group" x-data="{ closed: false }">
                                <span class="w-20 text-[10px] font-black uppercase" :class="closed ? 'text-red-500 opacity-50' : 'text-gray-400'">{{ $day }}</span>
                                <div class="flex-1 flex gap-3">
                                    <input type="time" name="schedule[{{ strtolower($day) }}][open]" :required="!closed" :disabled="closed" 
                                           class="flex-1 bg-black/50 border border-white/5 rounded-xl px-4 py-2 text-white text-xs focus:border-[#FF5F00] outline-none disabled:opacity-20 disabled:cursor-not-allowed">
                                    <input type="time" name="schedule[{{ strtolower($day) }}][close]" :required="!closed" :disabled="closed" 
                                           class="flex-1 bg-black/50 border border-white/5 rounded-xl px-4 py-2 text-white text-xs focus:border-[#FF5F00] outline-none disabled:opacity-20 disabled:cursor-not-allowed">
                                </div>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" @change="closed = !closed" name="schedule[{{ strtolower($day) }}][closed]"
                                           class="rounded bg-white/5 border-white/10 text-[#FF5F00] focus:ring-[#FF5F00]">
                                    <span class="text-[9px] font-black text-gray-600 uppercase">Fermé</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div x-show="step === 3" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4">
                <div class="bg-[#0A0A0A] border border-white/5 p-10 rounded-[2.5rem]">
                    <div class="flex items-center justify-between mb-10">
                        <h2 class="text-3xl font-black italic text-white uppercase tracking-tighter">Média & Gallery<span class="text-[#FF5F00]">.</span></h2>
                        <button type="button" @click="addImage()" class="bg-white/5 hover:bg-[#FF5F00] text-white px-6 py-2 rounded-full text-[9px] font-black uppercase tracking-widest transition-all tracking-[2px]">+ Galerie</button>
                    </div>

                    <div id="images-container" class="grid grid-cols-2 md:grid-cols-3 gap-6">
                        <div class="relative aspect-square group">
                            <label class="block w-full h-full border-2 border-dashed border-white/10 rounded-[2rem] cursor-pointer hover:border-[#FF5F00]/50 overflow-hidden bg-[#111] transition-all">
                                <input type="file" name="image_principal" required class="hidden" @change="preview($event)">
                                <img class="hidden w-full h-full object-cover">
                                <div class="placeholder flex flex-col items-center justify-center h-full gap-3">
                                    <div class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-[#FF5F00] shadow-lg">⭐</div>
                                    <span class="text-gray-500 text-[8px] font-black uppercase tracking-widest">Couverture *</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div x-show="step === 4" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4">
                <div class="bg-[#0A0A0A] border border-white/5 p-10 rounded-[2.5rem]">
                    <div class="flex items-center justify-between mb-10">
                        <h2 class="text-3xl font-black italic text-white uppercase tracking-tighter">La Carte<span class="text-[#FF5F00]">.</span></h2>
                        <button type="button" @click="addPlat()" class="bg-[#FF5F00] text-white px-6 py-2 rounded-full text-[9px] font-black uppercase tracking-widest">+ Ajouter Plat</button>
                    </div>

                    <div id="menu-container" class="space-y-4">
                        <template x-for="(plat, index) in plats" :key="index">
                            <div class="flex gap-4 p-4 bg-white/[0.02] rounded-[2rem] border border-white/5 animate-shake">
                                <input type="text" :name="'menu['+index+'][nom_plat]'" required placeholder="Nom du plat" 
                                       class="flex-1 bg-black/40 border border-white/5 rounded-2xl px-6 py-4 text-xs text-white focus:border-[#FF5F00] outline-none">
                                <input type="number" :name="'menu['+index+'][prix_plat]'" required placeholder="Prix" 
                                       class="w-32 bg-black/40 border border-white/5 rounded-2xl px-6 py-4 text-xs text-white focus:border-[#FF5F00] outline-none">
                                <button type="button" @click="removePlat(index)" class="text-red-500 hover:bg-red-500/10 w-12 rounded-2xl font-bold text-xl">×</button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <div class="mt-12 flex items-center justify-between gap-6">
                <button type="button" x-show="step > 1" @click="step--" 
                        class="px-10 py-6 rounded-[2rem] border border-white/10 text-white font-black uppercase text-[10px] tracking-[3px] hover:bg-white/5 transition-all">
                    Précédent
                </button>
                <div class="flex-1 text-center" x-show="step < 4">
                    <span class="text-[8px] text-gray-600 font-black uppercase tracking-[4px]">Presque fini !</span>
                </div>
                <button type="button" x-show="step < 4" @click="validateAndNext()" 
                        class="bg-white text-black px-14 py-6 rounded-[2rem] font-black uppercase text-[10px] tracking-[3px] hover:bg-[#FF5F00] hover:text-white transition-all shadow-2xl">
                    Suivant
                </button>
                <button type="submit" x-show="step === 4" 
                        class="bg-[#FF5F00] text-white px-14 py-6 rounded-[2rem] font-black uppercase text-[10px] tracking-[3px] shadow-[0_0_50px_rgba(255,95,0,0.3)] hover:scale-[1.05] transition-all">
                    Finaliser ✓
                </button>
            </div>
        </form>
    </div>

    <script>
        function restaurantForm() {
            return {
                step: 1,
                plats: [{ nom: '', prix: '' }],
                getStepTitle(i) {
                    return ['Identity', 'Details', 'Media', 'Menu'][i-1];
                },
                addPlat() { this.plats.push({ nom: '', prix: '' }); },
                removePlat(index) { if(this.plats.length > 1) this.plats.splice(index, 1); },
                
                preview(event) {
                    const input = event.target;
                    if (input.files && input.files[0]) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            const container = input.closest('label');
                            container.querySelector('img').src = e.target.result;
                            container.querySelector('img').classList.remove('hidden');
                            container.querySelector('.placeholder').classList.add('hidden');
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                },

                addImage() {
                    const container = document.getElementById('images-container');
                    const div = document.createElement('div');
                    div.className = 'relative aspect-square animate-shake';
                    const index = container.children.length;
                    div.innerHTML = `
                        <label class="block w-full h-full border-2 border-dashed border-white/10 rounded-[2rem] cursor-pointer hover:border-[#FF5F00]/50 overflow-hidden bg-[#111]">
                            <input type="file" name="images[]" class="hidden" onchange="previewManual(this)">
                            <img class="hidden w-full h-full object-cover">
                            <div class="placeholder flex items-center justify-center h-full text-gray-600 text-3xl">+</div>
                        </label>
                        <button type="button" onclick="this.parentElement.remove()" class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center shadow-xl">×</button>
                    `;
                    container.appendChild(div);
                },

                // VALIDATION INTELLIGENTE
                validateAndNext() {
                    const currentSection = document.querySelector(`[x-show='step === ${this.step}']`);
                    
                    // La magie est ici : On ignore les champs désactivés (disabled)
                    // Donc si un jour est "Fermé", ses inputs 'time' ne bloquent pas le formulaire !
                    const inputs = currentSection.querySelectorAll('input[required]:not(:disabled), select[required], textarea[required]');
                    let isValid = true;

                    inputs.forEach(input => {
                        let isFieldValid = true;

                        if (input.type === 'file') {
                            if (input.files.length === 0) isFieldValid = false;
                        } else if (!input.value || input.value.trim() === '') {
                            isFieldValid = false;
                        }

                        if (!isFieldValid) {
                            isValid = false;
                            const container = input.closest('div, label');
                            container.classList.add('border-red-500', 'animate-shake');
                            setTimeout(() => container.classList.remove('animate-shake'), 400);
                        } else {
                            input.closest('div, label').classList.remove('border-red-500');
                        }
                    });

                    if (isValid) {
                        this.step++;
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                }
            }
        }

        function previewManual(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const label = input.closest('label');
                    label.querySelector('img').src = e.target.result;
                    label.querySelector('img').classList.remove('hidden');
                    label.querySelector('.placeholder').classList.add('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>