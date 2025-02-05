<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            [220,'FERNANDES','nathalie.fernandes@mezi-line.fr','M.','NATHALIE','FERNANDES',2,3,[309]],
            [221,'LACHAIRE CAMARA','adom95@gmail.com','Mme','SANDRINE ','LACHAIRE CAMARA',2,3,[264]],
            [222,'KERBRAT','resp-cergy@domaliance.fr','Mme','JENNIFER','KERBRAT',2,3,[250]],
            [223,'COLAROSSI','resp-viarmes@domaliance.fr','Mme','VALERIE','COLAROSSI',2,3,[330]],
            [224,'MENHOUR','cleo95.franconville@cleo-group.fr','Mme','OUAHIBA','MENHOUR',2,3,[290]],
            [225,'SAMBE','cleo95.sarcelles@cleo-group.fr','Mme','NEYE','SAMBE',2,3,[276]],
            [226,'LOKOSSOU','sonia.lokossou@mezi-line.fr','Mme','SONIA','LOKOSSOU',2,3,[289]],
            [227,'ROUABHIA','cleo95.argenteuil@cleo-group.fr','Mme','SABRINA','ROUABHIA',2,3,[275]],
            [228,'TRETARRE','pascal.tretarre@mezi-line.fr','Mme','PASCAL','TRETARRE',2,3,[277]],
            [229,'SEBATTA','cleo95.sovon@cleo-group.fr','Mme','NORA','SEBATTA',2,3,[256]],
            [230,'KPESSE','kpesseedo@gmail.com','M.','EDO','KPESSE',2,3,[352]],
            [231,'KERROUMI','kerrouhakima@yahoo.fr','Mme','HAKIMA','KERROUMI',2,3,[287]],
            [232,'LOREAU','aloreau.askaloa@gmail.com','Mme','ANOUK','LOREAU',2,3,[322]],
            [233,'CELATI','guillaume.adenior@gmail.com','M.','GUILLAUME ','CELATI',2,3,[273]],
            [234,'DEBONS','admr-montmagny@fede95.admr.org','M.','PIERRE','DEBONS',2,3,[338]],
            [235,'REGNIER','admr-montsoult@fede95.admr.org','Mme','MANON','REGNIER',2,3,[348]],
            [236,'DUPONT','admr-plainedefrance@fede95.admr.org','M.','OLIVIER','DUPONT',2,3,[347]],
            [237,'FRUCHARD','admr-proalliance95@fede95.admr.org','M.','SYLVAIN','FRUCHARD',2,3,[341]],
            [238,'DAROUSSIN','pdaroussin@fede95.admr.org','M.','PAUL','DAROUSSIN',2,3,[343]],
            [239,'LAURENCE','l.monlouis@afad-idf.asso.fr','Mme','MONLOUIS','LAURENCE',2,3,[354]],
            [240,'TARTARE','aos-herblay@agedorservices.com','Mme','EVELYNE','TARTARE',2,3,[247]],
            [241,'PRUD\'HOMME','argenteuil@agedorservices.com','M.','OLIVIER','PRUD\'HOMME',2,3,[261]],
            [242,'EMLIK','agedorservices95@gmail.com','M.','MARC','EMLIK',2,3,[329]],
            [243,'FAVRO','ffavro@aetp-group.fr','Mme','FANNY','FAVRO',2,3,[395]],
            [244,'LAVITAL','ronny.lavital@aidvital','M.','RONNY','LAVITAL',2,3,[280]],
            [245,'RAPON','aides78@hotmail.fr','Mme','LINA','RAPON',2,3,[394]],
            [246,' DUMAY','caroline.dumay@alliance-vie.com','Mme','CAROLINE',' DUMAY',2,3,[270]],
            [247,'LOURIAIS','taverny@alliance-vie.com','Mme','FREDERIQUE','LOURIAIS',2,3,[270]],
            [248,'FILISETTI','contact@altidom.fr','M.','SEBASTIEN','FILISETTI',2,3,[311]],
            [249,'BOCQUET','am2s.adquotidien95@orange.fr','M.','PATRICE','BOCQUET',2,3,[265]],
            [250,'BASSAM','amad_enghien@hotmail.fr','Mme','ZEINAB','BASSAM',2,3,[342]],
            [251,'MASSUCCO','amdsausseron@outlook.fr','Mme','CLEMENTINE','MASSUCCO',2,3,[323]],
            [252,'TOUTLEMONDE','m.toulemonde@amelis-services.com','Mme','MAXIME','TOUTLEMONDE',2,3,[254]],
            [253,'ADIDA','contact-eaubonne@amelis-services.fr','M.','SERGE','ADIDA',2,3,[301]],
            [254,'SOARES','odile.soares@ami-services.fr','Mme','ODILE','SOARES',2,3,[362]],
            [255,'MILOSEVIC','maja.milosevic@amicial.fr','Mme','MAJA','MILOSEVIC',2,3,[344]],
            [256,'GHAFIR','ilham.ghafir@apef.fr','Mme','Ilham','GHAFIR',2,3,[291]],
            [257,'IRATENE','m.iratene@aquarelle-service.fr','M.','MOULOUD','IRATENE',2,3,[316]],
            [258,'QUELEN','quelen-ariaf@orange.fr','Mme','ISABELLE','QUELEN',2,3,[337]],
            [259,'HOF','emilie.hof@arpaviedom.fr','Mme','EMILIE','HOF',2,3,[346]],
            [260,'MAHMOUD','mieuxvivrechezsoia@free.fr','Mme','RIZIKY','MAHMOUD',2,3,[332]],
            [261,'JARIGE','accueil@amf-e.fr','Mme','ARMELLE','JARIGE',2,3,[359]],
            [262,'TCHOMY COLLET / LOBE','association.as95@yahoo.fr','Mme','ROSE','TCHOMY COLLET / LOBE',2,3,[350]],
            [263,'BOUBRIT','sboubrit@auxiliadom.com','M.','SALIM','BOUBRIT',2,3,[300]],
            [264,'NIZARD','n.nizard@auxiliaris.fr','M.','NIELS','NIZARD',2,3,[284]],
            [265,'HOARAU','jhoarau@auxilife.fr ','Mme','JULIE','HOARAU',2,3,[258]],
            [266,'BOUBY','marion.bouby@avidom.fr','Mme','MARION','BOUBY',2,3,[305]],
            [267,'BERNARDO','bernardo.isabel@coviva.fr','Mme','ISABEL','BERNARDO',2,3,[268]],
            [268,'GRACIEN','axe2vie@yahoo.fr','Mme','MARIE ARMELLE','GRACIEN',2,3,[293]],
            [269,'CRIGNON-GROUT','isleadam95@axeoservices.com','Mme','AUDREY','CRIGNON-GROUT',2,3,[271]],
            [270,'HAUTEREAU','mhauteau@axeoservices.com','Mme','MYLENE','HAUTEREAU',2,3,[317]],
            [271,'DORMEAU','jdormeau@axeoservices.com','Mme','JULIE','DORMEAU',2,3,[393]],
            [272,'BOURGEOIS','e.bourgeois@axeoservices.fr','Mme','ESTELLE','BOURGEOIS',2,3,[262]],
            [273,'NGO MBONG','belageservices@orange.fr','Mme','JANNINE','NGO MBONG',2,3,[335]],
            [274,'CANTZLER','mailys@cantzler.fr','M.','MAILYS','CANTZLER',2,3,[392]],
            [275,'DERIC','cathyservices@gmx.fr','M.','YVES','DERIC',2,3,[295]],
            [276,'AYME','melodie.ayme@ville-argenteuil.fr;','Mme','MELODIE','AYME',2,3,[364]],
            [277,'AUGER','mauger@arnouville95.org','Mme','MORGANE','AUGER',2,3,[365]],
            //[278,'STACINO','n.stacino@mairie-bezons.fr','Mme','NATHALIE','STACINO',2,3,[366]],
            [279,'DOREZ','odorez@eaubonne.fr','Mme','ODILE','DOREZ',2,3,[367]],
            [280,'VERSTRAETES','verstraetes@villedegarges.com','Mme','SANDRINE ','VERSTRAETES',2,3,[376]],
            [281,'THEMIOT','sthemiot@mairie-gonesse.fr','Mme','SANDRINE ','THEMIOT',2,3,[368]],
            [282,'LORQUIN','vlorquin@ville-montmorency.fr','Mme','VERONIQUE','LORQUIN',2,3,[369]],
            [283,'N\'TAMBWE BALIKA','n.ntambwe@mairie-saintgratien.fr','M.','NICODEME','N\'TAMBWE BALIKA',2,3,[371]],
            [284,'DESFONTAINES','veronique.desfontaines@ville-soa.fr','Mme','VERONIQUE','DESFONTAINES',2,3,[372]],
            [285,'CHARMANT','xcharmant@sannois.fr','M.','XAVIER','CHARMANT',2,3,[373]],
            [286,'DJITE','mad@ccas-sarcelles.fr','Mme','CODOU','DJITE',2,3,[374]],
            [287,'BITAM','contact@cibaid.fr','Mme','SYLVIE','BITAM',2,3,[283]],
            [288,'EVRARD','contact@declicc.fr','Mme','CONSTANCE','EVRARD',2,3,[299]],
            [289,'CHANTREL','christel.chantrel@sousmontoit.fr','Mme','CHRISTEL','CHANTREL',2,3,[263]],
            [290,'PAOLETTI LE BLOAS','l.paoletti@prestium.net','Mme','LAETITIA','PAOLETTI LE BLOAS',2,3,[391]],
            [291,'FAYOLLE','carole.cluzeau@domitys.fr','M.','CEDRIC','FAYOLLE',2,3,[327]],
            [292,'JEGOU','agence-groslay@domusvidomicile.com','Mme','CECILIA','JEGOU',2,3,[389]],
            [293,'CECILIA','agence-pontoise@domusvidomicile.com','Mme','GODEFROY','CECILIA',2,3,[253]],
            [294,'FRIQUET','afriquet@pro-seniors.fr','Mme','ANGELIQUE','FRIQUET',2,3,[292]],
            [295,'ROUDSARI','equipefamiliale@yahoo.fr','M.','NYMA','ROUDSARI',2,3,[336]],
            [296,'SANAMA','espuniversplus@yahoo.fr','Mme','ANNICK','SANAMA',2,3,[357]],
            [297,'GRANGHON','contact@etapres-services.fr','M.','ROMAIN','GRANGHON',2,3,[298]],
            [298,'ZAOUI','faroukzaoui@ymail.com','M.','FAROUK','ZAOUI',2,3,[304]],
            [299,'GAVERIAUX','vincent.gaveriaux@familles-services.com','M.','VINCENT','GAVERIAUX',2,3,[339]],
            [300,'MACE','contact@family-services95.fr','M.','GREGORY','MACE',2,3,[334]],
            [301,'OSSONO','v.ossono@galaad-autonomie.fr','M.','VALERIE','OSSONO',2,3,[285]],
            [302,'GONNET','montigny95@gdservices.fr','M.','JEAN','GONNET',2,3,[296]],
            [303,'ERBIL ','gheniassistance@gmail.com','Mme','OZLEM','ERBIL ',2,3,[282]],
            [304,'BELUS','valerie.belus@gmail.com','Mme','VALERIE','BELUS',2,3,[308]],
            [305,'GOUVERNET','florence.gouvernet@o2.fr','Mme','FLORENCE','GOUVERNET',2,3,[387]],
            [306,'KENNE','his@donnerlavieauxannees.com','M.','CHRISTIAN','KENNE',2,3,[320]],
            [307,'CRESPIN','hygieservices@orange.fr','Mme','NICOLE','CRESPIN',2,3,[274]],
            [308,'BAILLY','contact@justadom.com','M.','CEDRIC','BAILLY',2,3,[315]],
            [309,'RODRIGUES','laviefacile@orange.fr','M.','OLIVIER','RODRIGUES',2,3,[278]],
            [310,'TSHIALUSE MANDE','lavicado_78@yahoo.fr','M.','PAULIN','TSHIALUSE MANDE',2,3,[361]],
            [311,'HORVATIC','resp-gisors@azae.com','Mme','DEBORAH','HORVATIC',2,3,[302]],
            [312,'AH-YU','dir-templitudes-osny@domusvi.com','Mme','MARIE-HELENE','AH-YU',2,3,[324]],
            [313,'VAN LOO','direction@menageetvous.fr ','Mme','GERALDINE','VAN LOO',2,3,[281]],
            [314,'CHATEAUVIEUX','l.chateauvieux-mads@orange.fr','M.','LAURENT ','CHATEAUVIEUX',2,3,[251]],
            [315,'EL OUASSI','maisonetcompagnie@orange.fr','Mme','MARIE LINE','EL OUASSI',2,3,[266]],
            [316,'SARAH','servicequalite@onela.com','Mme','EL HANNOUDI','SARAH',2,3,[303]],
            [317,'FERNANDES','oceane.fernandes@o2.fr','Mme','OCEANE','FERNANDES',2,3,[319]],
            [318,'GAUTIER','cergypontoise@o2.fr','Mme','AURELIE','GAUTIER',2,3,[331]],
            [319,'DOROSTIAN','maximilien.dorostian@o2.fr','M.','MAXIMILIEN','DOROSTIAN',2,3,[294]],
            [320,'KADI','amina.kadi@o2.fr','Mme','AMINA','KADI',2,3,[286]],
            [321,'DEBRANCHE','vdebranche@omnica.fr','Mme','VERONIQUE','DEBRANCHE',2,3,[272]],
            [322,'DE BEIR','jdebeir@onela.com','M.','JEAN-FRANCOIS','DE BEIR',2,3,[267]],
            [323,'MICHEL','david.michel@ophs.fr','M.','DAVID','MICHEL',2,3,[385]],
            [324,'POCHELU','bruno.pochelu@pluriage-services.fr','M.','BRUNO','POCHELU',2,3,[259]],
            [325,'BILLARD','karine.billard@presence2000.fr','Mme','KARINE','BILLARD',2,3,[333]],
            [326,'CHARON','presadom@wanadoo.fr','Mme','ELISABETH',' CHARON',2,3,[358]],
            [327,'NGO POUTH','apaa2@hotmail.fr','Mme','RACHEL','NGO POUTH',2,3,[345]],
            [328,'KOESTEN','tania.koesten@lesessentielles.fr','Mme','TANIA','KOESTEN',2,3,[325]],
            [329,'GBAGUIDI','seniorplus@orange.fr','M.','ARISTIDE','GBAGUIDI',2,3,[255]],
            [330,'TECHTACH','dtechtach@seniorite-france.com','Mme','DJIDA','TECHTACH',2,3,[383]],
            [331,'PHULPIN','s.phulpin@3forets.fr','M.','SEBASTIEN','PHULPIN',2,3,[248]],
            [332,'MELO-AMELA','association.scpa@outlook.fr','Mme','VIVIANE','MELO-AMELA',2,3,[355]],
            [333,'BOP','contact@agencesibienchezvous.fr','M.','FAMARA','BOP',2,3,[279]],
            [334,'FATIMA','contact@team-aide.fr','Mme','OULD-KACI','FATIMA',2,3,[377]],
            [335,'MESSAOUDI','touslesjeunesenvacances@hotmail.com','M.','SOFIANE','MESSAOUDI',2,3,[384]],
            [336,'GERARD','f.gerard@toutadomservices.com','Mme','FABIENNE','GERARD',2,3,[312]],
            [337,'DELMON','k.delmon@toutadomservices.com','M.','KEVIN','DELMON',2,3,[297]],
            [338,'YAZGOREN','a.yazgoren@toutadomservices.com','Mme','AMEL','YAZGOREN',2,3,[257]],
            [339,'LEMAIRE','malika.lemaire@tremplin95.fr','Mme','MALIKA','LEMAIRE',2,3,[363]],
            //[340,'BOUGHABA','albert.boughaba@villabeausoleil.com','M.','ALBERT ','BOUGHABA',2,3,[326]],
            [341,'DJERIBAT','jalila.djeribat@vitalliance.fr','Mme','JALILA','DJERIBAT',2,3,[269]],
            [342,'FAURRE','remy.faurre@vivaservices.fr','M.','REMY ','FAURRE',2,3,[328]],
        ];

        foreach ($rows as $row) {
            $user = User::firstOrNew(['id' => $row[0]]);
            $user->name = $row[1];
            $user->email = $row[2];
            $user->civilite = $row[3];
            $user->prenom = $row[4];
            $user->nom = $row[5];
            $user->secteur_id = $row[6];
            $user->syncRoles($row[7]);
            $user->etablissements()->sync($row[8]);
            $user->actif = true;
            $user->password = bcrypt('Signes-95');
            $user->save();
        }
    }
}
