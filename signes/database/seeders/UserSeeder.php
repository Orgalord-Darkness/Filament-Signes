<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            //Agents CDVO
            [1,'FOIRET','christophe.foiret@valdoise.fr','M.','FOIRET','Christophe',null,1,[1]],
            [2,'BRAHIMI','zakia.brahimi@valdoise.fr','Mme','BRAHIMI','Zakia',null,1,[1]],
            [3,'NION','valerie.nion@valdoise.fr','Mme','NION','Valérie',null,4,[1]],
            [4,'BROUTIN','matthieu.broutin@valdoise.fr','M.','BROUTIN','Matthieu',null,4,[1]],
            [5,'WERMUTH','olivia.wermuth@valdoise.fr','Mme','WERMUTH','Olivia',null,2,[1]],
            [6,'TOUAUX','selena.touaux@valdoise.fr','Mme','TOUAUX','Séléna',null,2,[1]],
            [7,'JUSZCZAK','melanie.juszczak@valdoise.fr','Mme','JUSZCZAK','Mélanie',null,4,[1]],

            //Opérateurs ESSMS DELOS
            [8,'ABEL','sablonniere.direction@arpavie.fr','Mme','ABEL VARELAS','Lucia',4,3,[178,204]],
            [9,'AKADIRI','aakadiri@lavieaugrandair.fr','Mme','AKADIRI','Anzame',3,3,[25,229,235]],
            [10,'AMARA','direction-lessansonnets@mapad.fr','Mme','AMARA','Djamila',4,3,[160,194]],
            [11,'BROSSAIS','residence.desjardins@orange.fr','Mme','BROSSAIS','Amandine',4,3,[159]],
            [12,'ENGELHARD','anne-catherine.engelhard@valdoise.fr','Mme','ENGELHARD','Anne-Catherine',3,3,[131]],
            [13,'ROUBY','adeline.rouby@ch-argenteuil.fr','Mme','ROUBY','Adeline',4,3,[19]],
            [14,'FLORKOWSKI','direction.parmain@orpea.net','Mme','FLORKOWSKI','Anne',4,3,[147]],
            [15,'GUILON','petits-balcons.direction@arpavie.fr','Mme','GUILON','Aurélie',4,3,[192]],
            [16,'KHRIBECH','direction.lerenan@centfamilles.fr','Mme','KHRIBECH','Adime',3,3,[67]],
            [17,'CESSAC','direction@villajeannedarc.fr','Mme','CESSAC','Anne-Lise',4,3,[244]],
            [18,'BOUGHABA','albert.boughaba@villabeausoleil.com','M.','BOUGHABA','Albert',4,3,[243]],
            [19,'FREAUD','direction.lamontagnevivra@orange.fr','Mme','FREAUD','Anne-Marie',3,3,[33]],
            [20,'UGWE','anissa.ugwe@groupe-sos.org','Mme','UGWE','Anissa',3,3,[9,84]],
            [21,'SATHOUD','anne-sandrine.sathoud@croix-rouge.fr','Mme','SATHOUD','Anne-Sandrine',4,3,[60,140,151,201]],
            [22,'MOHAMED','assad.mohamed@groupe-sos.org','M.','MOHAMED','Assad',3,3,[12]],
            [23,'LENAIN','cedres.direction@arpavie.fr','Mme','LENAIN','Audrey',4,3,[187,191]],
            [24,'UDOL','audrey.udol@ville-argenteuil.fr','Mme','UDOL','Audrey',4,3,[150]],
            [25,'BOUCHENY','direction@residence-lestamaris.fr','M.','BOUCHENY','Bertrand',4,3,[37,125]],
            [26,'LATRACH','bekkay.latrach@anrs.asso.fr','M.','LATRACH','El Bekkay',3,3,[101]],
            [27,'TROTIN','spef.magny@lavieaugrandair.fr','M.','TROTIN','Bruno',3,3,[233]],
            [28,'DURANDCHR','c.durand@cat-avenir.com','M.','DURAND','Christophe',5,3,[236]],
            [29,'MATZ','c.matz@sinoplies.fr','Mme','MATZ','Carole',4,3,[102]],
            [30,'MONTALENT','c.montalent@agefo.fr','Mme','MONTALENT','Christelle',4,3,[163]],
            [31,'ORSEAU','c.orseau@ose-france.org','Mme','ORSEAU','Catherine',3,3,[98]],
            [32,'ANTONIO','cantonio@sauvegarde95.fr','Mme','ANTONIO','Céline',3,3,[7,45]],
            [33,'NGILLA','carine.ngilla@asmeg.org','Mme','NGILLA','Carine',4,3,[41,146]],
            [34,'MAGISTRALI','carole.magistrali@apf.asso.fr','Mme','MAGISTRALI','Carole',5,3,[49,75]],
            [35,'RYBSTEIN','carole.rybstein@fondation-opej.org','Mme','RYBSTEIN','Carole',3,3,[5]],
            [36,'CAMPOSs','ccampos@en-droits-denfance.fr','Mme','CAMPOS','Cathy',3,3,[28,43,44]],
            [37,'COUSSY','direction-js@epinomis.fr','Mme','COUSSY','Carine',4,3,[119]],
            [38,'GRANIER','celine.granier@korian.fr','Mme','GRANIER','Céline',4,3,[94]],
            [39,'FRILLONNET','cfrillonnet@magny-en-vexin.fr','Mme','FRILLONNET','Clarisse',4,3,[185]],
            [40,'ISART','christian.isart@ehpad-pdfc.fr','M.','ISART','Christian',4,3,[144,145]],
            [41,'LEMEAUX','ehd.saintgratien.direction@arpavie.fr','Mme','LE MEAUX','Christelle',4,3,[120]],
            [42,'MARKIEWICZ','direction@chabrand-thibault.com','M.','MARKIEWICZ','Christophe',4,3,[26,27]],
            [43,'UMONT','bonne-rencontre.direction@arpavie.fr','Mme','UMONT','Corinne',4,3,[172,175]],
            [44,'ROUDAUT','croudaut.pmennery@lna-sante.com','Mme','ROUDAUT','Charlotte',4,3,[117]],
            [45,'VILOCY','dir-eleusis-ezanville@domusvi.com','Mme','VILOCY','Céline',4,3,[115,116]],
            [46,'WEISS','sau.lamontagne.vivra@wanadoo.fr','Mme','WEISS','Christine',3,3,[217]],
            [47,'BRYCHE','d.bryche@aped-espoir.fr','M.','BRYCHE','Didier',5,3,[61,66,223]],
            [48,'DEMAZIERE','direction@chateaudeneuville.fr','Mme','DEMAZIERE','Delphine',4,3,[30]],
            [49,'GARRAUD','david.garraud@ville-beauchamp.fr','M.','GARRAUD','David',4,3,[164]],
            [50,'DJERIOU','direction-arcenciel@mapad.fr','Mme','DJERIOU','Dounia',4,3,[152]],
            [51,'GUIN','centremelia@wandoo.fr','Mme','GUIN','Dominique',3,3,[141]],
            [52,'BUJIRIRI','e.bujiriri@asaintvincent.fr','M.','BUJIRIRI','Emmanuel',3,3,[208]],
            [53,'ESCRIVA','e.escriva@groupecolisee.com','Mme','ESCRIVA','Elodie',4,3,[161]],
            [54,'PROTEAU','ehd.taverny.direction@arpavie.fr','Mme','PROTEAU','Elsa',4,3,[127]],
            [55,'JEANRENAUD','eric.jeanrenaud@apajh95.fr','M.','JEANRENAUD','Eric',5,3,[48]],
            [56,'ROBIC','elsa.robic@coallia.org','Mme','ROBIC','Elsa',3,3,[32]],
            [57,'PERILLAT','fraternite.st.jean@wanadoo.fr','Mme','PERILLAT','Elisabeth',3,3,[72,97]],
            [58,'POUGETOUX','dir-clos-bouchard@ehpad-sedna.fr','M.','POUGETOUX','Emmanuel',4,3,[182,183]],
            [59,'CARON','ermontdirection@arpavie.fr','M.','CARON','Steeve',4,3,[123]],
            [60,'VANNIER','emmanuel.vannier@cite-esperance.org','M.','VANNIER','Emmanuel',3,3,[31]],
            [61,'VASCONI','emmanuelle.vasconi@hevea-asso.fr','Mme','VASCONI','Emmanuelle',5,3,[57,221]],
            [62,'ALEZY','pivoines.direction@arpavie.fr','Mme','ALEZY','Florence',4,3,[170,193]],
            [63,'DESWARTE','f.deswarte@orpea.net','Mme','DESWARTE','Françoise',4,3,[104]],
            [64,'PARMENTIER','francois.parmentier@apf.asso.fr','M.','PARMENTIER','François',5,3,[213,220]],
            [65,'BEKKOUCH','fadila.bekkouch@univi.fr','Mme','BEKKOUCH','Fadila',4,3,[179]],
            [66,'CHAMMAH','fchammah@hgiap.fr','Mme','CHAMMAH','Fadi',4,3,[62,63,64]],
            [67,'JACQUES','rpautrillo.direction@orange.fr','Mme','JACQUES','Fabienne',4,3,[198]],
            [68,'JANUARIO','lespoussinets95@gmail.com','M.','JANUARIO','Frédéric',3,3,[122]],
            [69,'MICHEL','franck.michel@apajh95.fr','M.','MICHEL','Franck',5,3,[55]],
            [70,'FONTENY','g.fonteny@cheminsdesperance.org','Mme','FONTENY','Géraldine',4,3,[4,206]],
            [71,'BASSANGUEN','gbassanguen@mgen.fr','M.','BASSANGUEN','Gustave',4,3,[38,87,89]],
            [72,'QUENTIN','guy.quentin@residence-le-castel.com','M.','QUENTIN','Guy',4,3,[103]],
            [73,'TCHEUFFA','guy.tcheuffa@aaas.fr','M.','TCHEUFFA','Guy',4,3,[153]],
            [74,'SINDOUSSOULOU','sindoussoulouh@villedegarges.com','Mme','SINDOUSSOULOU','Hélène',4,3,[171]],
            [75,'GOB','stouen.fhe.direction@fondation-anais.org','M.','GOB','Hugues',5,3,[53,73,218]],
            [76,'PECHEREAU','isabelle.pechereau@hevea-asso.fr','Mme','PECHEREAU','Isabelle',5,3,[71,137]],
            [77,'COISNE','icoisne@lavieaugrandair.fr','Mme','COISNE','Isabelle',3,3,[2,136,240,241]],
            [78,'DELATAILLE','isabelle.de-la-taille@apprentis-auteuil.org','Mme','DE LA TAILLE','Isabelle',3,3,[10,132]],
            [79,'FERNANDES','j.fernandes@apajh.asso.fr','M.','FERNANDES','José',5,3,[56,226]],
            [80,'LENCHANTIN','j.lenchantin@orpea.net','Mme','LENCHANTIN','Jamie',4,3,[108]],
            [81,'PINSON','jean.pinson@ch-gonesse.fr','M.','PINSON','Jean',4,3,[20,21,22]],
            [82,'FLOURY','direction.bellefontaine@sgmr-ouest.com','M.','FLOURY','Jonathan',4,3,[216]],
            [83,'HILDERAL','direction.arnouville@orpea.net','Mme','HILDERAL','Jessie',4,3,[105]],
            [84,'LEVASSEUR','jlevasseur@eaubonne.fr','Mme','LEVASSEUR','Julie',4,3,[166]],
            [85,'SINZELLE','direction.gratien@iroisebellevie.com','M.','SINZELLE','Julien',4,3,[118]],
            [86,'LAFOND','julien.lafond@ch-simoneveil.fr','M.','LAFOND','Julien',4,3,[23,88,378,379]],
            [87,'CAILLAUD','jycaillaud@clinique-medicale-du-parc.fr','M.','CAILLAUD','Jean-Yves',4,3,[100]],
            [88,'REULEN','k.reulen@herblay.fr','Mme','REULEN','Karine',4,3,[189]],
            [89,'WINGEL','dir.fam@haarp.fr','Mme','WINGEL','Karine',5,3,[51]],
            [90,'BEUTIN','residence.carnelle@orange.fr','Mme','BEUTIN','Karine',4,3,[165]],
            [91,'DESCALZI','direction.lacerisaie@teneris.fr','Mme','DESCALZI','Karine',4,3,[95,96]],
            [92,'KAMENI','goussainville.direction@groupe-mieuxvivre.fr','M.','KAMENI','Dieudonné',4,3,[190]],
            [93,'ALA','l.ala@orpea.net','Mme','ALA ROMANET','Linda',4,3,[203]],
            [94,'COUCHAT','l.couchat@agefo.fr','Mme','COUCHAT','Lynda',4,3,[156]],
            [95,'DUMESNIL','laurent.dumesnil-adpj@hevea-asso.fr','M.','DUMESNIL','Laurent',3,3,[85]],
            [96,'TKOBOT','leila.tkobot@korian.fr','Mme','TKOBOT','Leïla',4,3,[92]],
            [97,'TASSONI','levalnotredame@hotmail.fr','Mme','TASSONI','xxx',4,3,[242]],
            [98,'HARKATI','lharkati@bellealliance.fr','Mme','HARKATI','Laila',5,3,[214]],
            [99,'JEAN','li.jean@orpea.net','Mme','JEAN','Linda',4,3,[155]],
            [100,'JOUNIAUX','enghien.direction@arpavie.fr','Mme','JOUNIAUX','Laurence',4,3,[154]],
            [101,'MARECHAL','lmarechal@igesa.fr','Mme','MARECHAL','Laurence',3,3,[86]],
            [102,'NOUVEL','lnouvel@solemnes.com','M.','NOUVEL','Louis',4,3,[237]],
            [103,'COHEN','m.cohen@ose-france.org','M.','COHEN','Marc',4,3,[1]],
            [104,'HENRY','m.henry@philanthropique.asso.fr','Mme','HENRY','Murielle',4,3,[124,246]],
            [105,'LANGLOIS','marie.langlois@ville-goussainville.fr','Mme','LANGLOIS','Marie',4,3,[381]],
            [106,'MARQUET','marquet.anabelle@ladapt.net','Mme','MARQUET','Annabelle',5,3,[212]],
            [107,'CAROLE','mathias.carole@residence-les-pensees.com','M.','CAROLE','Mathias',4,3,[121,380]],
            [108,'BOUBEKEUR','boubekeur.mustapha@ladapt.net','M.','BOUBEKEUR','Mustapha',5,3,[54,65,225]],
            [109,'DERRIEN','mc.derrien@safap95.fr','Mme','DERRIEN','Marie-Christine',3,3,[232]],
            [110,'DABIN','helenemoutetresponsable@arpavie.fr','Mme','DABIN','Marie',4,3,[167]],
            [111,'DELBE','mdelbe@ville-taverny.fr','Mme','DELBE','Constance',4,3,[173]],
            [112,'ESCANECRABE','mescanecrabe@jean-cotxet.asso.fr','M.','ESCANECRABE','Marc',3,3,[135]],
            [113,'HAMADI','dir-medicis-argenteuil@domusvi.com','Mme','HAMADI','Mariama',4,3,[199,200]],
            [114,'JARRYLACOMBE','marie.jarrylacombe@levaldocco.fr','Mme','JARRY-LACOMBE','Marie',3,3,[6]],
            [115,'RICHETGAILDRY','sas-ma-vallee@orange.fr','Mme','RICHET-GAILDRY','Marie-Lise',4,3,[139]],
            [116,'ANIBA','mouloud.aniba@apajh95.fr','M.','ANIBA','Mouloud',5,3,[18,219]],
            [117,'ROUSSEL','mroussel@levertlogis.org','Mme','ROUSSEL','Martine',3,3,[126]],
            [118,'SERAYET','mserayet@snc2h.fr','M.','SERAYET','Maxime',4,3,[188,202]],
            [119,'VINCENTDURAND','marpa.95@orange.fr','Mme','VINCENT-DURAND','Mylène',4,3,[138]],
            [120,'LEROUX','n.leroux@orpea.net','Mme','LEROUX','Nathalie',4,3,[106,107]],
            [121,'STACINO','n.stacino@mairie-bezons.fr','Mme','STACINO','Nathalie',4,3,[197]],
            [122,'BOULILA','touleuses.direction@arpavie.fr','Mme','BOULILA','Nabila',4,3,[174,195]],
            [123,'CICH','ccas-administration@viarmes.fr','Mme','CICH','Nadine',4,3,[180]],
            [124,'GURZYNSKI','nathalie.gurzynski@ville-argenteuil.fr','Mme','GURZYNSKI','Nathalie',4,3,[169]],
            [125,'LEROUXBADDI','nleroux-baddi@sauvegarde95.fr','Mme','LE ROUX BADDI','Natacha',3,3,[34,230]],
            [126,'ZIAMNI','residence.lepatio@groupe-mieuxvivre.fr','Mme','ZIAMNI','Nabila',4,3,[99,158,186]],
            [127,'BENEZECH','o.benezech@capdevant.fr','M.','BENEZECH','Olivier',5,3,[58,76]],
            [128,'COLLEONI','olivier.colleoni@apprentis-auteuil.org','M.','COLLEONI','Olivier',3,3,[134,228]],
            [129,'SUFT','olivier.suft@johnbost.fr','M.','SUFT','Olivier',5,3,[17,69,70]],
            [130,'VINSONNEAU','preslesdirection@arpavie.fr','M.','VINSONNEAU','Olivier',4,3,[129,205]],
            [131,'BOULY','closeraie.direction@arpavie.fr','Mme','BOULY','Pauline',4,3,[176]],
            [132,'SPINASBEYDON','pauline.spinas-beydon@apprentis-auteuil.org','Mme','SPINAS BEYDON','Pauline',3,3,[133]],
            [133,'NEVES','direction.montigny@orpea.net','Mme','NEVES','Peggy',4,3,[157]],
            [134,'CICHY','r.cichy@groupecolisee.com','M.','CICHY','Rémy',4,3,[184]],
            [135,'GARABEDIAN','r.garabedian@aaas.fr','M.','GARABEDIAN','Raffi',4,3,[181]],
            [136,'LOPEZMURIEL','raphael.lopez-muriel@croix-rouge.fr','M.','LOPEZ-MURIEL','Raphaël',3,3,[11,35,112,114,128,234]],
            [137,'BENGONO','stephane.bengono@fondation-ove.fr','M.','BENGONO','Stéphane',5,3,[16]],
            [138,'NIODO','s.niodo@aped-espoir.fr','Mme','NIODO','Sylvie',5,3,[148]],
            [139,'ROBARDEY','s.robardey@apui95.org','M.','ROBARDEY','Stéphane',4,3,[196]],
            [140,'TAMINESAMIA','directrice@ndm-ets.fr','Mme','TAMINE','Samia',3,3,[143]],
            [141,'TAMINESAMIR','samir.tamine@garelli95.org','M.','TAMINE','Samir',3,3,[80]],
            [142,'KAC','s.kac@ose-france.org','M.','KAC','Sébastien',3,3,[42]],
            [143,'KOUOH','fontaine.direction@arpavie.fr','Mme','KOUOH MOUKAKA','Sophie',4,3,[177]],
            [144,'LIBERAL','sliberal@sosve.org','Mme','LIBERAL','Séverine',3,3,[238]],
            [145,'RODRIGUEZ','sofia.rodriguez@korian.fr','Mme','RODRIGUEZ','Sofia',4,3,[90]],
            [146,'CALADO','stephanie.calado-cercas@korian.fr','Mme','CALADO CERCAS','Stéphanie',4,3,[91]],
            [147,'YAGOUB','ehd.gonesse.direction@arpavie.fr','Mme','YAGOUB','Sarah',4,3,[111]],
            [148,'MHAMDI','t.mhamdi@orpea.net','Mme','MHAMDI','Takoua',4,3,[162]],
            [149,'GERVAIS','v.gervais@lerenouveau.fr','Mme','GERVAIS','Valérie',3,3,[113]],
            [150,'SZWARCBART','opej-maubuisson@wanadoo.fr','Mme','SZWARCBART','Véronique',3,3,[29]],
            [151,'PERRET','veronique.perret@ght-novo.fr','Mme','PERRET','Véronique',4,3,[82,83,207,382]],
            [152,'BOKOBZA','virginie.bokobza@fondation-opej.org','Mme','BOKOBZA','Virginie',3,3,[231]],
            [153,'DAVID','virginie.david@ght-novo.fr','Mme','DAVID','Virginie',4,3,[3,40,81,239]],
            [154,'MENEUX','virginie.meneux@hevea-asso.fr','Mme','MENEUX','Virginie',3,3,[24,36,109]],
            [155,'LORQUIN','rpa@ville-montmorency.fr','Mme','LORQUIN','Véronique',4,3,[168]],
            [156,'JUILLE','y.juille@sinoplies.fr','M.','JUILLE','Yann',4,3,[110,245]],
            [157,'ZAOUI','zaoui.frederic@ladapt.net','M.','ZAOUI','Frédéric',5,3,[14,52]],
            [158,'ELBTIOUI','zineb.elbtioui@maisonsdefamille.com','M.','ELBTIOUI','Zineb',4,3,[130]],
            [159,'HAMDAN','zouhair.hamdan@korian.fr','M.','HAMDAN','Zoukair',4,3,[93]],

            //Agents CDVO
            [160,'VASSEUR','monique.vasseur@valdoise.fr','Mme','VASSEUR','Monique',null,4,[1]],
            [161,'DURANDROC','rocio.durand@valdoise.fr','Mme','DURAND','Rocio',null,2,[1]],
            [162,'HONORE','valerie.honore-rouge@valdoise.fr','Mme','HONORE ROUGE','Valérie',null,4,[1]],
            [163,'DECOCK','nathalie.decock@valdoise.fr','Mme','DECOCK','Nathalie',null,4,[1]],
        ];

        foreach ($rows as $row) {
            $user = User::firstOrNew(['id' => $row[0]]);
            $user->name = $row[1];
            $user->email = $row[2];
            $user->civilite = $row[3];
            $user->nom = $row[4];
            $user->prenom = $row[5];
            $user->secteur_id = $row[6];
            $user->syncRoles($row[7]);
            $user->etablissements()->sync($row[8]);
            $user->actif = true;
            $user->password = bcrypt('Signes-95');
            $user->save();
        }
    }
}
