<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Books;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     */


    public function run()
    {
        function randomDate($sStartDate, $sEndDate, $sFormat = 'Y-m-d') {
            // Convert the supplied date to timestamp
            $fMin = strtotime($sStartDate);
            $fMax = strtotime($sEndDate);
            // Generate a random number from the start and end dates
            $fVal = mt_rand($fMin, $fMax);
            // Convert back to the specified date format
            return date($sFormat, $fVal);
        }

        for ($i = 1 ;$i < 100; $i++){
            $date_random = randomDate('2000-07-09','2018-08-27');
            $firstname = array(
                'Johnathon',
                'Anthony',
                'Erasmo',
                'Raleigh',
                'Nancie',
                'Tama',
                'Camellia',
                'Augustine',
                'Christeen',
                'Luz',
                'Diego',
                'Lyndia',
                'Thomas',
                'Georgianna',
                'Leigha',
                'Alejandro',
                'Marquis',
                'Joan',
                'Stephania',
                'Elroy',
                'Zonia',
                'Buffy',
                'Sharie',
                'Blythe',
                'Gaylene',
                'Elida',
                'Randy',
                'Margarete',
                'Margarett',
                'Dion',
                'Tomi',
                'Arden',
                'Clora',
                'Laine',
                'Becki',
                'Margherita',
                'Bong',
                'Jeanice',
                'Qiana',
                'Lawanda',
                'Rebecka',
                'Maribel',
                'Tami',
                'Yuri',
                'Michele',
                'Rubi',
                'Larisa',
                'Lloyd',
                'Tyisha',
                'Samatha',
            );

            $lastname = array(
                'Mischke',
                'Serna',
                'Pingree',
                'Mcnaught',
                'Pepper',
                'Schildgen',
                'Mongold',
                'Wrona',
                'Geddes',
                'Lanz',
                'Fetzer',
                'Schroeder',
                'Block',
                'Mayoral',
                'Fleishman',
                'Roberie',
                'Latson',
                'Lupo',
                'Motsinger',
                'Drews',
                'Coby',
                'Redner',
                'Culton',
                'Howe',
                'Stoval',
                'Michaud',
                'Mote',
                'Menjivar',
                'Wiers',
                'Paris',
                'Grisby',
                'Noren',
                'Damron',
                'Kazmierczak',
                'Haslett',
                'Guillemette',
                'Buresh',
                'Center',
                'Kucera',
                'Catt',
                'Badon',
                'Grumbles',
                'Antes',
                'Byron',
                'Volkman',
                'Klemp',
                'Pekar',
                'Pecora',
                'Schewe',
                'Ramage',
            );
            $name = $firstname[rand ( 0 , count($firstname) -1)];
            $name .= ' ';
            $name .= $lastname[rand ( 0 , count($lastname) -1)];

            $title = $firstname[rand ( 0 , count($firstname) -1)];
            $genre = $lastname[rand ( 0 , count($lastname) -1)];
            Books::create([
                'title' => $title,
                'author' => $name,
                'genre' => $genre,
                'slug' => $genre,
                'description' => 'Lorem ipsum seeder example the qucik brown foc is here with us and we are glad to have you here'.$i,
                'image' => '',
                'isbn' => rand( 100000000000 , 9999999999999 ),
                'published' => $date_random,
                'publisher' =>$name.$i,

            ]);
        }
    }
}
