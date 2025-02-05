<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Etablissement;

class EtabSadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            //SADS
            ['AGE D\'OR SERVICES','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','58 allée des bois','',95306,'01 39 95 81 07','aos-herblay@agedorservices.com'],
            ['SERVICE DES TROIS FORETS','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','16 rue de la République','',95091,'01 39 35 28 49','3forets@wanadoo.fr'],
            ['SENIORS AVENUE / EPICURIA','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','62 rue du Général Leclerc','',95288,'01 39 83 19 40','seniorsavenue@hotmail.com'],
            ['DOMALIANCE CERGY','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','rue des chauffours','',95127,'01 85 60 58 76','resp-cergy@domaliance.fr'],
            ['MAINTIEN A DOMICILE SERVICES / AIDE A DOMICILE SERVICES','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','98 avenue du maréchal Joffre','',95018,'01 34 11 40 61','maintien-a-domicile-services@orange.fr'],
            ['SOPHIE SERVICES A LA PERSONNE','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','85 rue Gallieni','',95197,'01 34 05 89 96','sophie.aideadomicile@orange.fr'],
            ['DOMUSVI DOMICILE','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','22 rue Alexandre Prachay','',95500,'01 74 90 38 53','agence-pontoise@domusvidomicile.com'],
            ['AMELIS DOMICILE SERVICES','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','17 place Guy Moquet','',95052,'01 84 28 06 36','n.meilleur@amelis-services.fr'],
            ['SENIOR PLUS','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','36 avenue Frédéric Joliot Curie','',95268,'01 34 05 04 44','seniorplus@orange.fr'],
            ['AADSP SOVON / CLEO GROUP','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','1 rue Paul Eluard','',95018,'01 34 22 02 44','contact@cleo-group.fr'],
            ['TOUT A DOM SERVICES AUX PARTICULIERS / TOUT A DOM SERVICES','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','1 AVENUE DE L\'EUROPE','',95203,'01 34 16 58 70','a.yazgoren@toutadomservices.com'],
            ['AUXI LIFE 95','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','3 Résidence des Acacias','',95058,'01 30 34 71 97','Auxilife95@auxilife.fr'],
            ['PLURIAGE SERVICES','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','47 rue de Stalingrad','',95219,'01 39 78 01 47','bruno.pochelu@pluriage-services.fr'],
            ['ADHAP SERVICES - PRESTIUM','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','23 RUE ROBERT SCHUMANN','',95203,'01 39 59 32 65','domidom95@domidom.fr'],
            ['AGE D OR SERVICES / DB SERVICES','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','3 RUE VERTE','',95018,'01 34 34 06 46','argenteuil@agedorservices.com'],
            ['AXEO SERVICES TAVERNY / JMJU SERVICES','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','105 rue de Beauchamp ','',95607,'01 34 18 11 39','taverny@axeoservices.fr'],
            ['DESTIA / SOUS MON TOIT','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','82 RUE DE LA STATION','',95252,'01 34 14 30 62','christel.chantrel@sousmontoit.fr'],
            ['A DOM','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','32 rue de la Briqueterie','',95351,'01 34 72 76 10','adom95@gmail.com'],
            ['AM2S / ACCOMPAGNEMENT POUR LE BIEN ETRE PAR LES SERVICES A DOMICILE','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','9 chaussée Jules César',' Bâtiment 7',95476,'01 30 31 00 32','am2s.adquotidien95@orange.fr'],
            ['MAISON ET COMPAGNIE','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','23, rue Auguste Romagné','78700 CONFLANS SAINTE HONORINE',95998,'01 39 72 92 35','maisonetcompagnie@orange.fr'],
            ['BIEN A LA MAISON / ONELA','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','64 avenue de Stalingrad','',95018,'01 84 28 00 13','argenteuil@onela.com'],
            ['AVO SERVICES COVIVA','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','151 RUE MICHEL CARRE ','Porte 9',95018,'01 30 25 52 81','bernardo.isabel@coviva.fr'],
            ['VITALLIANCE','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','18 boulevard de la paix','',95127,'01 34 24 18 30','touria.hadi@vitalliance.fr'],
            ['ALLIANCE VIE','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','77 rue du Général Leclerc','',95203,'01 71 68 10 20','eaubonne@alliance-vie.com'],
            ['AXEO SERVICES / SAP VALMONTMORENCY','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','1 bis place Henri Sestre','',95598,'01 34 17 57 16','valmontmorency@axeoservices.fr'],
            ['OSDB / OMNICA SERVICE À LA PERSONNE','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','19 bis rue de la Tourelle','',95197,'01 34 05 88 02','osdb@omnica.fr'],
            ['AUTONOMIE SERENITE SERVICES - ADENIOR','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','35 RUE LOUIS SAVOIE','',95219,'01 39 59 78 40','contact@autonomie-serenite-services.fr'],
            ['HYGIE SERVICES','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','54 rue Alfred Lasson','78250 MEZY SUR SEINE',95998,'01 30 22 24 30','hygieservices@orange.fr'],
            ['AADSP SEVO / CLEO GROUP','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','1 ter rue Paul Eluard','',95018,'01 34 22 02 44','contact@cleo-group.fr'],
            ['AADSP NEVO / CLEO GROUP','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','18 avenue du 8 mai 1945','',95585,'01 34 22 02 44','contact@cleo-group.fr'],
            ['AADSP SOVO / CLEO GROUP','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','7 RUE DU PETIT ALBI','',95127,'01 34 22 02 44','contact@cleo-group.fr'],
            ['LA VIE FACILE','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','1 rue des charbonniers','',95199,'01 39 91 64 80','laviefacile@orange.fr'],
            ['SI BIEN CHEZ VOUS','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','22 rue Gustave Eiffel','78300 POISSY',95998,'01 39 22 39 44','contact@agencesibienchezvous.fr'],
            ['AID.VITAL','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','93 AVENUE PIERRE SEMARD','',95680,'01 39 92 40 95','contact@aidvital.com'],
            ['LFB - LES FAMILLES BONHEUR','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','25 AVENUE DE LA CONSTELLATION','',95127,'06 72 88 79 52','direction@menageetvous.fr'],
            ['GHENI ASSISTANCE','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','4 rue de la croix blanche','',95424,'06 51 67 15 64','gheniassistance@gmail.com'],
            ['CIBAID','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','10 Avenue de Rochefort ','78500 SARTROUVILLE',95998,'09 83 09 23 44','contact@cibaid.fr'],
            ['ALZHEIMER AIDANT ASSISTANCE / AUXILARIS','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','14 BIS RUE VICTOR MERIC ','92210 CLICHY',95998,'01 47 28 75 21','alzassoo@gmail.com'],
            ['GALAAD AUTONOMIE 95 / BIEN CHEZ VOUS GRACE A NOUS / BCVGN','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','34 rue Jean Jaurès','',95019,'01 39 88 59 45','contact@bcvgn.fr'],
            ['O2 SANNOIS','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','65 Boulevard Charles de Gaulle','',95582,'02 43 72 02 02','amina.kadi@o2.fr'],
            ['AD SENIORS 95','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','32 Boulevard du Port','',95127,'01 34 02 36 76','ads95nord@adseniors.com'],
            ['HANDICAP AUTISME PRESTATION PROFESSIONNALY SERVICES A LA PERSONNE / HAPPY SAP','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','Tour Europa Avenue de l Europe','94320 THIAIS',95998,'06 20 47 15 70','jferjul@gmail.com'],
            ['AADSP NOVAL / CLEO GROUP','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','7 RUE DU PETIT ALBI','',95127,'01 34 22 02 44','contact@cleo-group.fr'],
            ['AADSP CEVAL / CLEO GROUP','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','38 rue de la Station','',95252,'01 34 22 02 44','contact@cleo-group.fr'],
            ['APEF SERVICES / CERGY VEXIN HOME SERVICES','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','9 place de la piscine','',95500,'01 34 20 79 20','Sawsene.FERHAT@apef.fr'],
            ['ELICS SERVICES 78','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','7 RUE DU FOSSE','78600 MAISONS LAFITTE',95998,'01 75 93 80 31','contact78@pro-seniors.fr'],
            ['AXE2VIE (A2V)','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','32 rue Eugène sue','',95680,'06 22 97 15 44','axe2vie@yahoo.fr'],
            ['O2 ENGHIEN LES BAINS','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','65 Boulevard Charles de Gaulle','',95582,'07 75 21 53 45','axel.geridan@o2.fr'],
            ['CATHY SERVICES','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','22 RUE CARNOT','',95199,'09 50 69 62 90','cathy.service@gmx.fr'],
            ['GDS 78-95 SERVICES / GENERALE DES SERVICES','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','187 avenue du Maréchal Foch','78700 CONFLANS ST HONORINE',95998,'01 39 22 01 18','gonnet@generaledesservices.com'],
            ['DELTA SERVICES / TOUT A DOM SERVICES','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','56 avenue Marcel Perrin','',95394,'01 84 28 01 96','k.delmon@toutadomservices.com'],
            ['ET APRES SERVICES','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','1 PLACE CHARLES DE GAULLE ','78180 MONTIGNY LE BRETONNEUX',95998,'06 48 09 43 78','a.metayer@etapres-service.fr'],
            ['APPRENDRE AU QUOTIDIEN /  DECCLIC','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','14 AVENUE DE L\'EUROPE','',95680,'06 19 49 14 89','contact@declicc.fr'],
            ['AUXILIADOM','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','12 RUE DES CHAUFFOURS','',95127,'09 72 47 59 03','nbelaloui@auxiliadom.com'],
            ['AMELIS  GROUPE SODEXO','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','118 chaussée Jules César','',95203,'01 84 28 01 99','contact-eaubonne@amelis.services.fr'],
            ['LE PSAD-AZAE-GISORS','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','46 rue du général Roguet','92110 CLICHY',95998,'01 41 06 04 03','celine.francisco@azae.com'],
            ['NOUVEL HORIZON SERVICES','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','14 allée Georges Pompidou','94300 VINCENNES',95998,'01 43 98 12 29','lamar@nouvelhorizon.fr'],
            ['FAMILIA SERVICES','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','93 AVENUE PIERRE SEMARD','',95680,'01 34 53 01 44','faroukzaoui@ymail.com'],
            ['AVIDOM','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','22 rue Henri Regnault ','75014 PARIS',95998,'01 45 43 88 40','marion.bouby@avidom.fr'],
            ['SERENA','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','118 avenue de Paris','79000 NIORT',95999,'09 69 32 83 27','arnaud.barais@ima.eu'],
            ['PETITS-FILS (VALTEO)','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','2 rue de Malleville','',95210,'06 34 06 51 92','antoine.lechatelier@petits-fils.com'],
            ['GPAAD / BELUS VALERIE','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','PLACE DES LIBERTES','27140 GISORS',95999,'02 32 15 94 08','valerie.belus@gmail.com'],
            ['QUATRE MAINS SERVICE A DOMICILE','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','11 route de Beauvais','',95213,'01 34 66 67 78','4mains.services@sfr.fr'],
            ['TOUJOURS PRESENT POUR VOUS','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','1 RUE DE L\'ESCOUVRIER','',95585,'09 72 81 06 68',''],
            ['ALTIDOM ALP','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','54 route de Sartrouville ','78230 LE PECQ',95998,'01 30 15 09 00','contact@altidom.fr'],
            ['LE COMPTOIR DES SERVICES A DOMICILE / TOUT A DOM SERVICES','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','65 AVENUE GEORGES CLEMENCEAU','60300 SENLIS',95999,'03 44 56 47 22','f.gerard@toutadomservices.com'],
            ['APA / ALLIANCE VIE','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','142 RUE DE PARIS','',95607,'01 39 32 12 94','taverny@alliance-vie.com'],
            ['PETITS-FILS PONTOISE','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','28 RUE DE LA BRETONNERIE','',95500,'01 84 27 06 85','evelyne.rigatti@petit-fils.com'],
            ['JUSTADOM','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','11 Boulevard de la résistance','',95018,'01 76 29 50 34','contact@justadom.com'],
            ['AQUARELLE SERVICE PONTOISE / DOMILOU','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','5 PLACE DU GRAND MARTROY','',95500,'06 23 82 19 51','m.iratene@aquarelle-service.fr'],
            ['AXEO SERVICES MARINES / JMJU SERVICES','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','45 BOULEVARD CHARLES DE GAULLES','',95370,'01 34 18 11 39','taverny@axeoservices.fr'],
            ['SERVICE DES TROIS FORETS','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','15 BOULEVARD DU MARECHAL FOCH','',95555,'01 39 35 28 49','3forets@wanadoo.fr'],
            ['AXEO SERVICES / GLSAP','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','92BIS BOULEVARD CHARLES DE GAULLE','',95582,'01 39 61 50 49',''],
            ['O2 BEAUMONT','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','1 RUE LEON GODIN','',95052,'07 75 27 40 17','beaumont@o2.fr'],
            ['AXEO SERVICES / SAP VALMONTMORENCY','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','22 RUE SAINT LAZARRE','',95313,'01 34 17 57 16',''],
            ['HETEP YAOUT SERVICES / HIS','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','37B /39 Avenue du Général Leclerc','',95598,'01 43 52 64 23','his@donnerlavieauxannees.com'],
            ['GIMS - GROUPEMENT INTERPROFESSIONNEL D INTERET MEDICO-SOCIAL','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','111 BOULEVARD DU GENERAL DELAMBR','',95018,'06 58 80 77 68','contact@giims.org'],
            ['ADENIOR CERGY PONTOISE - ASKALOA','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','6 PLACE DE LA CORNE','',95500,'06 98 64 23 89','aloreau.askaloa@gmail.com'],
            ['AMD SAUSSERON','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','1bis rue THIEBAULT','',95446,'07 71 35 31 00','amdsausseron@outlook.fr'],
            ['LA GIRANDIERE - RESIDE ETUDES SENIORS','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','7 RUE PAUL EMILE VICTOR','',95476,'01 30 17 48 00','marie-helene.ah-yu@reside-etudes.fr'],
            ['RESIDENCE ADAMOISE SENIOR / LES ESSENTIELLES','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','15 AVENUE DE PARIS','',95313,'01 82 40 02 99',''],
            ['VILLA BEAUSOLEIL CORMEILLES','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','1 RUE LEOPOLD MOURIER','',95176,'01 34 50 11 11','melanie@villabeausoleil.com'],
            ['DOMITYS GALILEE','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','7 RUE DES MARJOBERTS','',95127,'01 88 26 02 00','gauthier.pare@domitys.fr'],
            ['TRISKELL SERVICES / VIVA SERVICES','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','18 AVENUE DU GENERAL LECLERC','',95051,'01 39 32 02 95','agence.beauchamp@vivaservices.fr'],
            ['AGE D OR SERVICE L\'ISLE ADAM / SERVICES D OR','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','80 ROUTE DE CREIL','',95058,'09 62 63 84 97','memlik98@gmail.com'],
            ['DOMALIANCE VIARMES','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','73 RUE DE PARIS','',95652,'01 34 09 81 16','resp-viarmes@domaliance.fr'],
            ['O2 CERGY','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','12-14 rue des chauffours','',95127,'06 73 45 52 43','touriaberrabah@o2.fr'],
            ['ASSOCIATION MIEUX VIVRE CHEZ SOI','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','51 rue Carnot','',95427,'01 39 84 99 61','mieuxvivrechezsoia@free.fr'],
            ['PRESENCE 2000','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','63 rue des Chauffours','',95127,'01 30 17 12 23','info@presence2000.fr'],
            ['FAMILY SERVICES','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','5 bis boulevard Gambetta','',95582,'01 39 82 00 50','contact@family-services95.fr'],
            ['ASSOCIATION BEL AGE ET SERVICES','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','5 AVENUE DU STADE','',95229,'01 39 90 65 51','belageservices@orange.fr'],
            ['EQUIPE FAMILIALE','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','50 bis rue Charles de Gaulle','',95197,'01 39 83 02 25','equipefamiliale@yahoo.fr'],
            ['ARIAF (ASSOCIATION REGIONALE INTERCOMMUNALE AIDE FAMILIALE','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','32 rue de la Mare des Noues','',95252,'01 34 44 00 95','ariaf95@orange.fr'],
            ['ADMR - ASSOPEP','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','5BIS ROUTE DE SAINT LEU','',95427,'01 34 05.22.61','ckoudrine@fede95.admr.org'],
            ['FAMILLES SERVICES','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','21 avenue des Genottes','',95127,'01 34 02 07 07','corfa.familles-services@orange.fr'],
            ['RE-SOURCE','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','1 rue Jean Moulin','',95428,'01 30 10 25 90','re.source@wanadoo.fr'],
            ['ADMR - PRO ALLIANCE 95','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','17-19 avenue du Général de Gaulle','',95598,'01 34 17 20 34','proalliance95@free.fr'],
            ['AMAD ENGHIEN','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','57 rue du Général de Gaulle','',95210,'01 34 12 96 24','amad_enghein@hotmail.fr'],
            ['ADMR VEXIN-CERGY AGGLO','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','40 RUE DE CROSNE','',95355,'01 34 46 83 99',''],
            ['AMICIAL','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','8 rue Maurice Dampierre','',95572,'01 34 30 80 40','maja.milosevic@amicial.fr'],
            ['PROXIM AIDE ASSISTANCE','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','2 rue Berthelot','',95268,'01 39 87 57 48','apaa2@hotmail.fr'],
            ['ARPAVIE@DOM','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','2 Rue de Chantepuits','',95306,'01 34 18 11 24','info@association-familia.fr'],
            ['SENIOR PLUS','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','18 avenue Voltaire','',95598,'01 34 05 04 44','seniorplus@orange.fr'],
            ['ADMR PLAINE DE FRANCE','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','7 rue de Paris','',95652,'01 30 35 40 47','madmrdelaplainedefrance@sfr.fr'],
            ['ADMR MONTSOULT  ET SES ENVIRONS','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','21 rue de la Mairie','',95430,'01 34 73 11 89','admr-montsoult@fede95.admr.org'],
            ['FAMILY SERVICES','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','11 rue Ferdinand de Lesseps','',95091,'01 39 35 10 94','familyservices95@free.fr'],
            ['FAMILLES SERVICES','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','2 rue de l\'Abbaye du Val','',95392,'01 30 36 00 54','corfa.familles-services@orange.fr'],
            ['ALDS SAP','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','25 avenue des Aulnes ','78250 MEULAN',95998,'01 34 74 80 60','gheriba.yakini@alds.org'],
            ['ASSOCIATION DES SENIORS DU 95','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','10 bis Avenue Paul Valéry','',95585,'06 39 93 92 66','association.as95@yahoo.fr'],
            ['FAMILLE ET CITE','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','1 RUE DU PRE SAINT GERVAIS','93500 PANTIN',95998,'01 56 56 43 50','secretariat75@famille-et-cite.asso.fr'],
            ['ADMR VEXIN-CERGY AGGLO','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','4 Grande Rue','',95651,'01 34 78 09 20','admr-nucourt@fede95.admr.org'],
            ['AB SERADOM / ACCOMPAGNEMENT PAR LE BIEN ETRE PAR LES SERVICES A DOMICILE','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','34 avenue de l Escouvrier ','ZA - Bât.BSN',95585,'01 34 04 10 08','abseradom@gmail.com'],
            ['ACCOMPAGNEMENT INSERTION DEVOIRS ESTHETIQUES SERVICES / AIDES 78','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','1 ALLEE DES PINSONS ','78200 MAGNANVILLE',95998,'09 61 67 19 93','aides78@hotmail.fr'],
            ['FAMILLES SERVICES','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','14 rue Puisaye','',95210,'01 39 59 14 74','corfa.familles-services@orange.fr'],
            ['AFAD / ASSOCIATION AIDE FAMILIALE A DOMICILE','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','3 PASSAGE PAUL ELUARD','',95199,'01 39 91 92 00','l.monlouis@afad-idf.asso.fr'],
            ['SERVICE ET CONFORT POUR LA PERSONNE AGEE / SCPA','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','14 avenue de l Europe','',95680,'06 58 28 09 17','association.scpa@outlook.fr'],
            ['ASSOCIATION VIVRE MIEUX CHEZ SOI','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','36 rue Auguste Pollain ','93200 ST DENIS',95998,'01 48 21 67 90',''],
            ['ESPERANCE UNIVERS PLUS / EUP','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','27 avenue Jean Moulin ','93140 BONDY',95998,'01 41 55 31 48',''],
            ['PRESENCE A DOMICILE','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','11 RUE ERNEST GOUIN','78290 CROISSY SUR SEINE',95998,'01 39 76 31 32',''],
            ['ASSOCIATION AMFD / AIDE AUX MERES ET AUX FAMILLES A DOMICILE','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','1 AVENUE SALVADOR ALLENDE ','93800 EPINAY SUR SEINE',95998,'01 48 17 78 50','ajarrige@amf.fr'],
            ['ASSOCATION FAMILIALE DE SERVICES A LA PERSONNE','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','53 rue Mirabeau','',95063,'01 39 80 66 29','felicite.vincent@afasep.fr'],
            ['LAVICADO 78','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','13 impasse Emile Zola','78200 MANTES LA JOLIE',95998,'09 73 64 34 38','lavicado_78@yahoo.fr'],
            ['AMI SERVICES','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','31 cours Albert 1er','',95203,'01 39 59 22 33','association@ami-services.fr'],
            ['TREMPLIN 95','D_STRUCTxxSADxx',2,28,'ASSO','SE','CD','6 allée des promeneurs','',95199,'01 39 91 18 10','tremplin@tremplin95.fr'],
            ['CCAS ARGENTEUIL','D_STRUCTxxSADxx',2,28,'PUBLIC','SE','CD','12-14 Boulevard Léon Feix','',95018,'01 34 23 44 97','marielaure.anton@ville-argenteuil.fr'],
            ['CCAS ARNOUVILLE','D_STRUCTxxSADxx',2,28,'PUBLIC','SE','CD','15-17 rue Robert Schuman','',95019,'01 34 45 97 00','ccas@ml.arnouville95.org'],
            ['CCAS BEZONS','D_STRUCTxxSADxx',2,28,'PUBLIC','SE','CD','2 rue de la mairie','',95063,'01 34 76 72 39','n.stacino@mairie-bezons.fr'],
            ['CCAS EAUBONNE','D_STRUCTxxSADxx',2,28,'PUBLIC','SE','CD','1 rue d Enghien','',95203,'01 34 27 26 72','jboudier@eaubonne.fr'],
            ['CCAS GONESSE','D_STRUCTxxSADxx',2,28,'PUBLIC','SE','CD','1 rue Pierre SALVI','',95268,'01 30 11 55 20','sthemiot@mairie-gonesse.fr'],
            ['CCAS MONTMORENCY','D_STRUCTxxSADxx',2,28,'PUBLIC','SE','CD','17 avenue Charles de Gaulle','',95428,'01 34 17 60 99','ccas@ville-montmorency.fr'],
            ['CCAS ROISSY EN FRANCE','D_STRUCTxxSADxx',2,28,'PUBLIC','SE','CD','2 rue Jean Moulin','',95527,'01 34 38 52 01','eliazord@ville-roissy95.fr'],
            ['CCAS ST GRATIEN','D_STRUCTxxSADxx',2,28,'PUBLIC','SE','CD','Place Gambetta','',95555,'01 34 17 84 58','v.berment@mairie-saintgratien.fr'],
            ['CCAS ST OUEN L\'AUMONE','D_STRUCTxxSADxx',2,28,'PUBLIC','SE','CD','2 place Pierre Mendès-France','',95572,'01 34 21 25 34','tony.martins@ville-soa.fr'],
            ['CCAS SANNOIS','D_STRUCTxxSADxx',2,28,'PUBLIC','SE','CD','Place du Général Leclerc ','',95582,'01 39 98 35 16','aide.a.domicile@sannois.org'],
            ['CCAS SARCELLES','D_STRUCTxxSADxx',2,28,'PUBLIC','SE','CD','4 place de Navarre','',95585,'01 34 38 20 88','madsarcelles@yahoo.fr'],
            ['CCAS ST BRICE SOUS FORET','D_STRUCTxxSADxx',2,28,'PUBLIC','SE','CD','14 rue de Paris','',95539,'01 34 29 42 16','adom-ccas@saintbrice95.fr'],
            ['CCAS GARGES LES GONESSE','D_STRUCTxxSADxx',2,28,'PUBLIC','SE','CD','8 place de l\'hôtel de ville','',95268,'01 34 53 32 00','accueilccas@villedegarges.com'],
            //Ajout
            ['TEAM-AIDE','D_STRUCTxxSADxx',2,28,'PRIVELUC','SE','CD','39 BOULEVARD DE LA MUETTE','',95268,'01 34 04 25 22','contact@team-aide.fr'],
        ];

        foreach ($rows as $row) {
            $etab = Etablissement::firstOrNew(['nom' => $row[0]]);
            $etab->delos = $row[1];
            $etab->secteur_id = $row[2];
            $etab->categorie_id = $row[3];
            $etab->statut = $row[4];
            $etab->type = $row[5];
            $etab->competence = $row[6];
            $etab->adresse = $row[7];
            $etab->adresse2 = $row[8];
            $etab->commune_id = $row[9];
            $etab->tel = $row[10];
            $etab->email = $row[11];
            $etab->actif = 1;
            $etab->save();
        }
    }
}
