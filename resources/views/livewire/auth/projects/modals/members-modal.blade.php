<div>
    <flux:modal name="show-members" class="w-auto">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Miembros del proyecto {{ $project->project_name }}</flux:heading>
                <flux:text class="mt-2">Este proyecto cuenta con <strong>{{ $totalMembers + 1 }}</strong> {{ $totalMembers >
                    1 ?
                    'colaboradores' : 'colaborador' }}
                </flux:text>
                @if ($showMessage)
                <div wire:transition class="mt-3" wire:poll.5s='hiddenMessage'>
                    <x-u-i.alert type="{{ $type }}" message='{{ $message }}' />
                </div>
                @endif
            </div>

            <div class="mx-auto">
                <div class="bg-white shadow-sm rounded p-3 border-l-4 border-pink-500 mb-2 ">
                    <div class="flex justify-between items-center">
                        <div class="flex gap-2">
                            @if (Auth::user()->photo && Storage::disk('public')->exists(Auth::user()->photo))
                            <flux:avatar circle name="{{ Auth::user()->name }}" color="auto"
                                color:seed="{{ Auth::id()}}" size="sm" src="{{ Storage::url(Auth::user()->photo) }}" />
                            @else
                            <flux:avatar circle name="{{ Auth::user()->name }}" color="auto"
                                color:seed="{{ Auth::id()}}" size="sm" />
                            @endif

                            <div class="flex flex-col">
                                <flux:heading>{{ Auth::user()->name }} <flux:badge size="sm" color="blue"
                                        class="ml-1 max-sm:hidden">Tu</flux:badge>
                                </flux:heading>
                                <flux:text class="max-sm:hidden">{{ Auth::user()->email }}</flux:text>
                            </div>
                        </div>
                    </div>
                </div>
                @forelse ($members as $member)
                <div wire:key="members-{{ $member->id }}"
                    class="bg-white shadow-sm rounded p-3 border-l-4 border-pink-500 mb-2 ">
                    <div class="flex justify-between items-center">
                        <div class="flex gap-2">
                            @if ($member->user->photo)
                            <flux:avatar circle name="{{ $member->user->name }}" color="auto"
                                color:seed="{{ $member->user->id }}" size="sm"
                                src="{{ Storage::url($member->user->photo) }}" />
                            @else
                            <flux:avatar circle name="{{ $member->user->name }}" color="auto"
                                color:seed="{{ $member->user->id }}" size="sm" />
                            @endif

                            <div class="flex flex-col">
                                <flux:heading>{{ $member->user->name }}
                                </flux:heading>
                                <flux:text class="max-sm:hidden">{{ $member->user->email }}</flux:text>
                            </div>
                        </div>
                        <div class="flex gap-3 items-center">
                            <flux:select size="sm" wire:model='roles.{{ $member->id }}' wire:change="changeRole({{ $member->id }})" wire:target="changeRole({{ $member->id }})"
                                placeholder="Elige un rol...">
                                @forelse ($this->getRoles as $role)
                                <flux:select.option value="{{ $role->id }}">{{ $role->name }}</flux:select.option>
                                @empty
                                <flux:select.option>{{ 'Sin roles disponibles' }}</flux:select.option>
                                @endforelse
                            </flux:select>
                            <flux:button type='submit' wire:click='openModalMemberDelete({{ $member->id }})'
                                wire:loading.attr='disabled' wire:target='openModalMemberDelete({{ $member->id }})'
                                size='xs' variant='danger' icon='trash'>
                            </flux:button>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-slate-600 text-center">No hay colaboradores en el proyecto, <button
                        wire:click='openModalMember' class="hover:text-pink-500 transition-colors cursor-pointer">Agrega
                        uno</button></p>
                @endforelse
            </div>
            <div class="p-3 mt-2">
                {{ $members->links() }}
            </div>
        </div>
    </flux:modal>
    <livewire:auth.projects.modals.delete-member-modal :project="$project" />
</div>
