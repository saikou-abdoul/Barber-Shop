<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\Service;
use App\Models\Utilisateur;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Créer les rôles
        $roles = [
            ['libelle' => 'admin'],
            ['libelle' => 'coiffeur'],
            ['libelle' => 'client'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        // Créer des utilisateurs de test
        $adminRole = Role::where('libelle', 'admin')->first();
        $coiffeurRole = Role::where('libelle', 'coiffeur')->first();
        $clientRole = Role::where('libelle', 'client')->first();

        // Admin
        Utilisateur::create([
            'nom' => 'Admin',
            'prenom' => 'Super',
            'email' => 'admin@salon.com',
            'mot_de_passe' => Hash::make('password'),
            'id_role' => $adminRole->id_role,
        ]);

        // Coiffeurs
        Utilisateur::create([
            'nom' => 'Martin',
            'prenom' => 'Sophie',
            'email' => 'sophie@salon.com',
            'mot_de_passe' => Hash::make('password'),
            'id_role' => $coiffeurRole->id_role,
        ]);

        Utilisateur::create([
            'nom' => 'Dubois',
            'prenom' => 'Marc',
            'email' => 'marc@salon.com',
            'mot_de_passe' => Hash::make('password'),
            'id_role' => $coiffeurRole->id_role,
        ]);

        // Clients
        Utilisateur::create([
            'nom' => 'Dupont',
            'prenom' => 'Jean',
            'email' => 'jean@example.com',
            'mot_de_passe' => Hash::make('password'),
            'id_role' => $clientRole->id_role,
        ]);

        // Services
        $services = [
            [
                'nom_service' => 'Coupe Homme',
                'description' => 'Coupe classique pour homme',
                'prix' => 25.00,
                'duree_minutes' => 30,
            ],
            [
                'nom_service' => 'Coupe Femme',
                'description' => 'Coupe et brushing pour femme',
                'prix' => 45.00,
                'duree_minutes' => 60,
            ],
            [
                'nom_service' => 'Coloration',
                'description' => 'Coloration complète',
                'prix' => 80.00,
                'duree_minutes' => 120,
            ],
            [
                'nom_service' => 'Shampooing',
                'description' => 'Shampooing et soin',
                'prix' => 15.00,
                'duree_minutes' => 20,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
