<x-app-layout>

<div class="max-w-7xl mx-auto p-6">
    <div class="bg-white shadow rounded-lg p-6">
        <!-- Section Informations utilisateur -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold mb-4">Informations sur l'utilisateur</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-700"><span class="font-bold">Nom :</span> {{ $utilisateur->name }}</p>
                    <p class="text-gray-700"><span class="font-bold">Matricule :</span> {{ $utilisateur->matricule }}</p>
                    <p class="text-gray-700"><span class="font-bold">Adresse :</span> {{ $utilisateur->address ?? 'Non spécifiée' }}</p>
                </div>
                <div>
                    <p class="text-gray-700"><span class="font-bold">Catégorie :</span> {{ $utilisateur->categorie->nom }}</p>
                    <p class="text-gray-700"><span class="font-bold">Salaire journalier :</span> {{ $utilisateur->categorie->salaire }} FC</p>
                    <p class="text-gray-700"><span class="font-bold">Lieu de travail :</span> {{ $utilisateur->lieu->nom }}</p>
                </div>
            </div>
        </div>

        <!-- Section Présences -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold mb-4">Historique des présences</h2>
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">Date</th>
                            <th class="border px-4 py-2">Type</th>
                            <th class="border px-4 py-2">Distance (m)</th>
                            <th class="border px-4 py-2">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presences as $presence)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($presence->date)->format('d/m/Y H:i') }}</td>
                            <td class="border px-4 py-2">
                                {{ $presence->type == 1 ? 'Arrivée' : 'Départ' }}
                            </td>
                            <td class="border px-4 py-2">
                                {{ number_format($presence->distance, 2) }}
                            </td>
                            <td class="border px-4 py-2">
                                <span class="inline-block px-2 py-1 rounded text-white {{ $presence->statut === 'Absent' ? 'bg-red-500' : ($presence->statut === 'Présent et à l\'heure' ? 'bg-green-500' : 'bg-yellow-500') }}">
                                    {{ $presence->statut }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Section Résumé du paiement -->
        <div>
            <h2 class="text-2xl font-semibold mb-4">Résumé du paiement</h2>
            <p class="text-gray-700">
                <span class="font-bold">Jours travaillés :</span> {{ $joursTravailles }}
            </p>
            <p class="text-gray-700">
                <span class="font-bold">Total à payer :</span> {{ $totalPayer }} FC
            </p>
        </div>
    </div>
</div>
</x-app-layout>
