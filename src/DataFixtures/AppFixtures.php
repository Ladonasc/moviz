<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Store;
use App\Entity\Category;
use App\Entity\Language;
use App\Entity\Person;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AppFixtures extends Fixture implements ContainerAwareInterface
{
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $this->_loadUsers($manager);
        $this->_loadStore($manager);
        $this->_loadCategories($manager);
        $this->_loadLanguages($manager);
        $this->_loadPersons($manager);

        $manager->flush();
    }

    private function _loadUsers(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('a@a.fr')
             ->setRole('ROLE_USER');

        $encoded = $this->container->get("security.password_encoder")
            ->encodePassword($user, '111111');

        $user->setPassword($encoded);

        $manager->persist($user);
    }

    private function _loadStore(ObjectManager $manager)
    {
        $store = new Store();
        $store->setLabel('Testing store');

        $manager->persist($store);
    }

    private function _loadCategories(ObjectManager $manager)
    {
        $categories = [
            [ "tmdbId" => 2, "label" => "Action" ],
            [ "tmdbId" => 1, "label" => "Aventure" ],
            [ "tmdbId" => 1, "label" => "Animation" ],
            [ "tmdbId" => 3, "label" => "Comédie" ],
            [ "tmdbId" => 8, "label" => "Crime" ],
            [ "tmdbId" => 9, "label" => "Documentaire" ],
            [ "tmdbId" => 1, "label" => "Drame" ],
            [ "tmdbId" => 1075, "label" => "Familial" ],
            [ "tmdbId" => 1, "label" => "Fantastique" ],
            [ "tmdbId" => 3, "label" => "Histoire" ],
            [ "tmdbId" => 2, "label" => "Horreur" ],
            [ "tmdbId" => 1040, "label" => "Musique" ],
            [ "tmdbId" => 964, "label" => "Mystère" ],
            [ "tmdbId" => 1074, "label" => "Romance" ],
            [ "tmdbId" => 87, "label" => "Science-Fiction" ],
            [ "tmdbId" => 1077, "label" => "Téléfilm" ],
            [ "tmdbId" => 5, "label" => "Thriller" ],
            [ "tmdbId" => 1075, "label" => "Guerre" ],
            [ "tmdbId" => 3, "label" => "Western" ],
        ];

        foreach ($categories as $cat) {
            $category = new Category();
            $category->setLabel($cat['label'])
                 ->setTmdbId($cat['tmdbId']);

            $manager->persist($category);
        }
    }

    private function _loadLanguages(ObjectManager $manager)
    {
        $languages = [
            [ 'code' => 'aa', 'label' => 'Afar', 'active' => false ],
            [ 'code' => 'ab', 'label' => 'Abkhaze', 'active' => false ],
            [ 'code' => 'ae', 'label' => 'Avestique', 'active' => false ],
            [ 'code' => 'af', 'label' => 'Afrikaans', 'active' => false ],
            [ 'code' => 'ak', 'label' => 'Akan', 'active' => false ],
            [ 'code' => 'am', 'label' => 'Amharique', 'active' => false ],
            [ 'code' => 'an', 'label' => 'Aragonais', 'active' => false ],
            [ 'code' => 'ar', 'label' => 'Arabe', 'active' => false ],
            [ 'code' => 'as', 'label' => 'Assamais', 'active' => false ],
            [ 'code' => 'av', 'label' => 'Avar', 'active' => false ],
            [ 'code' => 'ay', 'label' => 'Aymara', 'active' => false ],
            [ 'code' => 'az', 'label' => 'Azéri', 'active' => false ],
            [ 'code' => 'ba', 'label' => 'Bachkir', 'active' => false ],
            [ 'code' => 'be', 'label' => 'Biélorusse', 'active' => false ],
            [ 'code' => 'bg', 'label' => 'Bulgare', 'active' => false ],
            [ 'code' => 'bh', 'label' => 'Bihari', 'active' => false ],
            [ 'code' => 'bi', 'label' => 'Bichelamar', 'active' => false ],
            [ 'code' => 'bm', 'label' => 'Bambara', 'active' => false ],
            [ 'code' => 'bn', 'label' => 'Bengali', 'active' => false ],
            [ 'code' => 'bo', 'label' => 'Tibétain', 'active' => false ],
            [ 'code' => 'br', 'label' => 'Breton', 'active' => false ],
            [ 'code' => 'bs', 'label' => 'Bosnien', 'active' => false ],
            [ 'code' => 'ca', 'label' => 'Catalan', 'active' => true ],
            [ 'code' => 'ce', 'label' => 'Tchétchène', 'active' => false ],
            [ 'code' => 'ch', 'label' => 'Chamorro', 'active' => false ],
            [ 'code' => 'co', 'label' => 'Corse', 'active' => false ],
            [ 'code' => 'cr', 'label' => 'Cri', 'active' => false ],
            [ 'code' => 'cs', 'label' => 'Tchèque', 'active' => false ],
            [ 'code' => 'cu', 'label' => 'Vieux-slave', 'active' => false ],
            [ 'code' => 'cv', 'label' => 'Tchouvache', 'active' => false ],
            [ 'code' => 'cy', 'label' => 'Gallois', 'active' => false ],
            [ 'code' => 'da', 'label' => 'Danois', 'active' => true ],
            [ 'code' => 'de', 'label' => 'Allemand', 'active' => true ],
            [ 'code' => 'dv', 'label' => 'Maldivien', 'active' => false ],
            [ 'code' => 'dz', 'label' => 'Dzongkha', 'active' => false ],
            [ 'code' => 'ee', 'label' => 'Ewe', 'active' => false ],
            [ 'code' => 'el', 'label' => 'Grec moderne', 'active' => false ],
            [ 'code' => 'en', 'label' => 'Anglais', 'active' => true ],
            [ 'code' => 'eo', 'label' => 'Espéranto', 'active' => false ],
            [ 'code' => 'es', 'label' => 'Espagnol', 'active' => true ],
            [ 'code' => 'et', 'label' => 'Estonien', 'active' => false ],
            [ 'code' => 'eu', 'label' => 'Basque', 'active' => false ],
            [ 'code' => 'fa', 'label' => 'Persan', 'active' => false ],
            [ 'code' => 'ff', 'label' => 'Peul', 'active' => false ],
            [ 'code' => 'fi', 'label' => 'Finnois', 'active' => false ],
            [ 'code' => 'fj', 'label' => 'Fidjien', 'active' => false ],
            [ 'code' => 'fo', 'label' => 'Féroïen', 'active' => false ],
            [ 'code' => 'fr', 'label' => 'Français', 'active' => true ],
            [ 'code' => 'fy', 'label' => 'Frison occidental', 'active' => false ],
            [ 'code' => 'ga', 'label' => 'Irlandais', 'active' => true ],
            [ 'code' => 'gd', 'label' => 'Écossais', 'active' => true ],
            [ 'code' => 'gl', 'label' => 'Galicien', 'active' => false ],
            [ 'code' => 'gn', 'label' => 'Guarani', 'active' => false ],
            [ 'code' => 'gu', 'label' => 'Gujarati', 'active' => false ],
            [ 'code' => 'gv', 'label' => 'Mannois', 'active' => false ],
            [ 'code' => 'ha', 'label' => 'Haoussa', 'active' => false ],
            [ 'code' => 'he', 'label' => 'Hébreu', 'active' => false ],
            [ 'code' => 'hi', 'label' => 'Hindi', 'active' => false ],
            [ 'code' => 'ho', 'label' => 'Hiri motu', 'active' => false ],
            [ 'code' => 'hr', 'label' => 'Croate', 'active' => false ],
            [ 'code' => 'ht', 'label' => 'Créole haïtien', 'active' => false ],
            [ 'code' => 'hu', 'label' => 'Hongrois', 'active' => true ],
            [ 'code' => 'hy', 'label' => 'Arménien', 'active' => false ],
            [ 'code' => 'hz', 'label' => 'Héréro', 'active' => false ],
            [ 'code' => 'ia', 'label' => 'Interlingua', 'active' => false ],
            [ 'code' => 'id', 'label' => 'Indonésien', 'active' => false ],
            [ 'code' => 'ie', 'label' => 'Occidental', 'active' => false ],
            [ 'code' => 'ig', 'label' => 'Igbo', 'active' => false ],
            [ 'code' => 'ii', 'label' => 'Yi', 'active' => false ],
            [ 'code' => 'ik', 'label' => 'Inupiak', 'active' => false ],
            [ 'code' => 'io', 'label' => 'Ido', 'active' => false ],
            [ 'code' => 'is', 'label' => 'Islandais', 'active' => true ],
            [ 'code' => 'it', 'label' => 'Italien', 'active' => true ],
            [ 'code' => 'iu', 'label' => 'Inuktitut', 'active' => false ],
            [ 'code' => 'ja', 'label' => 'Japonais', 'active' => true ],
            [ 'code' => 'jv', 'label' => 'Javanais', 'active' => false ],
            [ 'code' => 'ka', 'label' => 'Géorgien', 'active' => false ],
            [ 'code' => 'kg', 'label' => 'Kikongo', 'active' => false ],
            [ 'code' => 'ki', 'label' => 'Kikuyu', 'active' => false ],
            [ 'code' => 'kj', 'label' => 'Kuanyama', 'active' => false ],
            [ 'code' => 'kk', 'label' => 'Kazakh', 'active' => false ],
            [ 'code' => 'kl', 'label' => 'Groenlandais', 'active' => false ],
            [ 'code' => 'km', 'label' => 'Khmer', 'active' => false ],
            [ 'code' => 'kn', 'label' => 'Kannada', 'active' => false ],
            [ 'code' => 'ko', 'label' => 'Coréen', 'active' => true ],
            [ 'code' => 'kr', 'label' => 'Kanouri', 'active' => false ],
            [ 'code' => 'ks', 'label' => 'Cachemiri', 'active' => false ],
            [ 'code' => 'ku', 'label' => 'Kurde', 'active' => false ],
            [ 'code' => 'kv', 'label' => 'Komi', 'active' => false ],
            [ 'code' => 'kw', 'label' => 'Cornique', 'active' => false ],
            [ 'code' => 'ky', 'label' => 'Kirghiz', 'active' => false ],
            [ 'code' => 'la', 'label' => 'Latin', 'active' => false ],
            [ 'code' => 'lb', 'label' => 'Luxembourgeois', 'active' => true ],
            [ 'code' => 'lg', 'label' => 'Ganda', 'active' => false ],
            [ 'code' => 'li', 'label' => 'Limbourgeois', 'active' => false ],
            [ 'code' => 'ln', 'label' => 'Lingala', 'active' => false ],
            [ 'code' => 'lo', 'label' => 'Lao', 'active' => false ],
            [ 'code' => 'lt', 'label' => 'Lituanien', 'active' => false ],
            [ 'code' => 'lu', 'label' => 'Luba-katanga', 'active' => false ],
            [ 'code' => 'lv', 'label' => 'Letton', 'active' => false ],
            [ 'code' => 'mg', 'label' => 'Malgache', 'active' => false ],
            [ 'code' => 'mh', 'label' => 'Marshallais', 'active' => false ],
            [ 'code' => 'mi', 'label' => 'Maori de Nouvelle-Zélande', 'active' => false ],
            [ 'code' => 'mk', 'label' => 'Macédonien', 'active' => false ],
            [ 'code' => 'ml', 'label' => 'Malayalam', 'active' => false ],
            [ 'code' => 'mn', 'label' => 'Mongol', 'active' => false ],
            [ 'code' => 'mo', 'label' => 'Moldave', 'active' => false ],
            [ 'code' => 'mr', 'label' => 'Marathi', 'active' => false ],
            [ 'code' => 'ms', 'label' => 'Malais', 'active' => false ],
            [ 'code' => 'mt', 'label' => 'Maltais', 'active' => false ],
            [ 'code' => 'my', 'label' => 'Birman', 'active' => false ],
            [ 'code' => 'na', 'label' => 'Nauruan', 'active' => false ],
            [ 'code' => 'nb', 'label' => 'Norvégien Bokmål', 'active' => false ],
            [ 'code' => 'nd', 'label' => 'Sindebele', 'active' => false ],
            [ 'code' => 'ne', 'label' => 'Népalais', 'active' => false ],
            [ 'code' => 'ng', 'label' => 'Ndonga', 'active' => false ],
            [ 'code' => 'nl', 'label' => 'Néerlandais', 'active' => true ],
            [ 'code' => 'nn', 'label' => 'Norvégien Nynorsk', 'active' => false ],
            [ 'code' => 'no', 'label' => 'Norvégien', 'active' => true ],
            [ 'code' => 'nr', 'label' => 'Nrebele', 'active' => false ],
            [ 'code' => 'nv', 'label' => 'Navajo', 'active' => false ],
            [ 'code' => 'ny', 'label' => 'Chichewa', 'active' => false ],
            [ 'code' => 'oc', 'label' => 'Occitan', 'active' => false ],
            [ 'code' => 'oj', 'label' => 'Ojibwé', 'active' => false ],
            [ 'code' => 'om', 'label' => 'Oromo', 'active' => false ],
            [ 'code' => 'or', 'label' => 'Oriya', 'active' => false ],
            [ 'code' => 'os', 'label' => 'Ossète', 'active' => false ],
            [ 'code' => 'pa', 'label' => 'Pendjabi', 'active' => false ],
            [ 'code' => 'pi', 'label' => 'Pali', 'active' => false ],
            [ 'code' => 'pl', 'label' => 'Polonais', 'active' => true ],
            [ 'code' => 'ps', 'label' => 'Pachto', 'active' => false ],
            [ 'code' => 'pt', 'label' => 'Portugais', 'active' => true ],
            [ 'code' => 'qu', 'label' => 'Quechua', 'active' => false ],
            [ 'code' => 'rc', 'label' => 'Créole Réunionnais', 'active' => false ],
            [ 'code' => 'rm', 'label' => 'Romanche', 'active' => false ],
            [ 'code' => 'rn', 'label' => 'Kirundi', 'active' => false ],
            [ 'code' => 'ro', 'label' => 'Roumain', 'active' => true ],
            [ 'code' => 'ru', 'label' => 'Russe', 'active' => true ],
            [ 'code' => 'rw', 'label' => 'Kinyarwanda', 'active' => false ],
            [ 'code' => 'sa', 'label' => 'Sanskrit', 'active' => false ],
            [ 'code' => 'sc', 'label' => 'Sarde', 'active' => false ],
            [ 'code' => 'sd', 'label' => 'Sindhi', 'active' => false ],
            [ 'code' => 'se', 'label' => 'Same du Nord', 'active' => false ],
            [ 'code' => 'sg', 'label' => 'Sango', 'active' => false ],
            [ 'code' => 'sh', 'label' => 'Serbo-croate', 'active' => false ],
            [ 'code' => 'si', 'label' => 'Cingalais', 'active' => false ],
            [ 'code' => 'sk', 'label' => 'Slovaque', 'active' => false ],
            [ 'code' => 'sl', 'label' => 'Slovène', 'active' => false ],
            [ 'code' => 'sm', 'label' => 'Samoan', 'active' => false ],
            [ 'code' => 'sn', 'label' => 'Shona', 'active' => false ],
            [ 'code' => 'so', 'label' => 'Somali', 'active' => false ],
            [ 'code' => 'sq', 'label' => 'Albanais', 'active' => false ],
            [ 'code' => 'sr', 'label' => 'Serbe', 'active' => false ],
            [ 'code' => 'ss', 'label' => 'Swati', 'active' => false ],
            [ 'code' => 'st', 'label' => 'Sotho du Sud', 'active' => false ],
            [ 'code' => 'su', 'label' => 'Soundanais', 'active' => false ],
            [ 'code' => 'sv', 'label' => 'Suédois', 'active' => true ],
            [ 'code' => 'sw', 'label' => 'Swahili', 'active' => false ],
            [ 'code' => 'ta', 'label' => 'Tamoul', 'active' => false ],
            [ 'code' => 'te', 'label' => 'Télougou', 'active' => false ],
            [ 'code' => 'tg', 'label' => 'Tadjik', 'active' => false ],
            [ 'code' => 'th', 'label' => 'Thaï', 'active' => true ],
            [ 'code' => 'ti', 'label' => 'Tigrigna', 'active' => false ],
            [ 'code' => 'tk', 'label' => 'Turkmène', 'active' => false ],
            [ 'code' => 'tl', 'label' => 'Tagalog', 'active' => false ],
            [ 'code' => 'tn', 'label' => 'Tswana', 'active' => false ],
            [ 'code' => 'to', 'label' => 'Tongien', 'active' => false ],
            [ 'code' => 'tr', 'label' => 'Turc', 'active' => true ],
            [ 'code' => 'ts', 'label' => 'Tsonga', 'active' => false ],
            [ 'code' => 'tt', 'label' => 'Tatar', 'active' => false ],
            [ 'code' => 'tw', 'label' => 'Twi', 'active' => false ],
            [ 'code' => 'ty', 'label' => 'Tahitien', 'active' => false ],
            [ 'code' => 'ug', 'label' => 'Ouïghour', 'active' => false ],
            [ 'code' => 'uk', 'label' => 'Ukrainien', 'active' => true ],
            [ 'code' => 'ur', 'label' => 'Ourdou', 'active' => false ],
            [ 'code' => 'uz', 'label' => 'Ouzbek', 'active' => false ],
            [ 'code' => 've', 'label' => 'Venda', 'active' => false ],
            [ 'code' => 'vi', 'label' => 'Vietnamien', 'active' => true ],
            [ 'code' => 'vo', 'label' => 'Volapük', 'active' => false ],
            [ 'code' => 'wa', 'label' => 'Wallon', 'active' => false ],
            [ 'code' => 'wo', 'label' => 'Wolof', 'active' => false ],
            [ 'code' => 'xh', 'label' => 'Xhosa', 'active' => false ],
            [ 'code' => 'yi', 'label' => 'Yiddish', 'active' => false ],
            [ 'code' => 'yo', 'label' => 'Yoruba', 'active' => false ],
            [ 'code' => 'za', 'label' => 'Zhuang', 'active' => false ],
            [ 'code' => 'zh', 'label' => 'Chinois', 'active' => true ],
            [ 'code' => 'zu', 'label' => 'Zoulou', 'active' => false ],
        ];

        foreach ($languages as $lang) {
            $language = new Language();
            $language
                ->setCode($lang['code'])
                ->setLabel($lang['label'])
                ->setIsActive($lang['active']);

            $manager->persist($language);
        }
    }

    protected function _loadPersons($manager)
    {
        $persons = [
            // --- actors
            [ 'identity' => 'Hugh Grant', 'director' => false, 'actor' => true ],
            [ 'identity' => 'Diane Kruger', 'director' => false, 'actor' => true ],
            [ 'identity' => 'Bruce Willis', 'director' => false, 'actor' => true ],

            // --- directors
            [ 'identity' => 'Steven Spielberg', 'director' => true, 'actor' => false ],
            [ 'identity' => 'George Lucas', 'director' => true, 'actor' => false ],

            // -- both
            [ 'identity' => 'George Clooney', 'director' => true, 'actor' => true ],
            [ 'identity' => 'Robert De Niro', 'director' => true, 'actor' => true ],
        ];

        foreach ($persons as $pers) {
            $person = new Person();
            $person
                ->setIdentity($pers['identity'])
                ->setIsDirector($pers['director'])
                ->setIsActor($pers['actor']);

            $manager->persist($person);
        }
    }
}
