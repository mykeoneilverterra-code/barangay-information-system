<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $announcements = [

            [
                'title' =>
                    'Clean-Up Drive',

                'description' =>
                    'Barangay-wide clean-up drive this Saturday. Let us keep our community clean and green!',

                'category' =>
                    'Community',

                'announcement_date' =>
                    '2026-09-25',

                'status' =>
                    'Published',
            ],

            [
                'title' =>
                    'SK Assembly',

                'description' =>
                    'Youth assembly and planning session for upcoming community activities and projects.',

                'category' =>
                    'Youth',

                'announcement_date' =>
                    '2026-09-24',

                'status' =>
                    'Published',
            ],

            [
                'title' =>
                    'Vaccination Day',

                'description' =>
                    'Free vaccination program for children and senior citizens at the Barangay Health Center.',

                'category' =>
                    'Health',

                'announcement_date' =>
                    '2026-09-22',

                'status' =>
                    'Published',
            ],

            [
                'title' =>
                    'Council Meeting',

                'description' =>
                    'Regular Barangay Council Meeting regarding upcoming community programs and development projects.',

                'category' =>
                    'Government',

                'announcement_date' =>
                    '2026-09-20',

                'status' =>
                    'Published',
            ],

            [
                'title' =>
                    'Dengue Awareness Campaign',

                'description' =>
                    'Community information campaign about dengue prevention and maintaining clean surroundings.',

                'category' =>
                    'Health',

                'announcement_date' =>
                    '2026-09-18',

                'status' =>
                    'Draft',
            ],

        ];


        foreach ($announcements as $announcement) {

            Announcement::updateOrCreate(

                [
                    'title' =>
                        $announcement['title'],

                    'announcement_date' =>
                        $announcement[
                            'announcement_date'
                        ],
                ],

                $announcement

            );

        }
    }
}