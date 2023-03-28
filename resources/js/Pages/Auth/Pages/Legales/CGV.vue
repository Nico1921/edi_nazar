<script setup>
    import { Head } from '@inertiajs/inertia-vue3';
 </script>
<script >

    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

    export default {
    // Using a render function
    layout: (h, page) => h(AuthenticatedLayout, () => child),

    // Using the shorthand
    layout: AuthenticatedLayout,
    }
</script>
<template>
   <Head :title="'Condition Générale de Vente'" /> 
   <section class="container mx-auto mt-5 px-4">
      <h1 class="font-bold lg:text-3xl sm:text-xl text-lg text-gray-800 text-center pb-1 pt-5 px-2">Condition Générale de Vente</h1>
      <span class="italic text-gray-400">Dernière mise à jour : 03 février 2023</span>

      <article class="mt-4">
         <p>
            Les présentes conditions générales de vente («
            Conditions de Vente ») établissent les termes
            conformément auxquels nous fournissons les
            produits (« Produit » ou « Produits »).
            Lisez attentivement les présentes Conditions de
            Vente avant de commander les Produits de
            notre marque.
         </p>
         
         <p>
            Les présentes Conditions de Vente vous indiquent qui nous sommes,
            comment nous mettons nos Produits à votre disposition, comment le
            contrat peut être résilié à votre initiative et à la nôtre, ce que vous
            devez faire en cas de problème, et vous communiquent d’autres
            informations importantes. Si vous n’acceptez pas les présentes
            Conditions de Vente, vous ne devez pas commander de Produit.
         </p>
      </article>
      
      <ol class="first-list">
         <li>Information nous concernant
            <ol class="ml-3">
               <li> La société NAZAR RUGS, société par action simplifiée. Nous sommes immatriculés en tant
                     que société en France sous le n° 53817549800046. Notre siège social est situé au 1625 route
                     de Sandillon 45560 Saint Denis en Val. Notre n° de TVA intracommunautaire est le
                     FR15538175498. Numéro AGEC : 4000011837. Numéro Eco-participation : FR300617_01XGTT
               </li>
            </ol>
         </li>
         <li>Commande de produits
            <ol class="ml-3">
               <li>Vous reconnaissez qu’en passant commande, vous contractez l’obligation de payer les
                  Produits commandés si nous acceptons votre commande.</li>
               <li>Notre procédure de commande vous permet de contrôler et de corriger toute erreur
                  avant de nous transmettre votre commande. Prenez le temps de lire et de vérifier votre
                  commande à chaque étape de la procédure de commande.
               </li>
               <li>Toutes les commandes sont soumises à notre acceptation. Après réception de votre
                  commande, nous vous enverrons un e-mail de confirmation qui vaudra acceptation de notre
                  part. Le contrat entre vous et nous ne sera conclu qu’une fois que nous vous aurons envoyé
                  cet e-mail. Le paiement du prix de la commande par le mode de paiement de votre choix
                  sera exécuté dès que nous aurons accepté votre commande. Nous vous adresserons un
                  autre e-mail dès que votre commande aura été expédiée.
               </li>
               <li>Malheureusement, nous ne pouvons plus annuler une commande une fois qu’elle est en
                  cours de préparation. Si vous changez d’avis concernant votre commande alors qu’elle est
                  déjà en cours de préparation, vous pouvez refuser la livraison ou nous retourner les Produits
                  conformément à la politique relative aux retours, qui est exposée dans la clause 9 ci-dessous.
               </li>
               <li>Avant de nous commander des Produits, il vous appartient de vérifier et de vous assurer
                  que vous êtes en mesure de recevoir les Produits commandés, et notamment de vérifier
                  qu’ils entreront facilement dans la pièce de votre choix, qu’ils conviennent à cette pièce et
                  qu’ils peuvent passer par la porte de votre appartement ou de la pièce, par les escaliers et
                  par les portes, et qu’aucun autre problème ne risque de compliquer la livraison ou de la
                  rendre impossible.
               </li>
               <li>Vous devez tenir à jour les coordonnées que vous nous avez communiquées de
                  manière que nous puissions vous contacter si nécessaire concernant votre commande ou la
                  livraison des Produits.
               </li>
            </ol>
         </li>
         <li>Disponibilité
            <ol class="ml-3">
               <li>
                  Toutes les commandes de Produits sont sous réserve de la disponibilité des Produits
                  commandés et des matériaux à partir desquels ils sont fabriqués. Si, pour quelque motif que
                  ce soit, les Produits que vous avez commandés ne sont pas disponibles ou leur livraison
                  retardée, nous vous en informerons dans les meilleurs délais après avoir reçu votre
                  commande.
               </li>
               <li>
                  Si nous ne sommes pas en mesure de fournir un Produit, par exemple parce qu’il n’est
                  plus en stock chez le fabricant ou en raison d’une erreur de prix, nous vous en informerons
                  par email et ne donnerons pas suite à votre commande. Si vous avez déjà payé le Produit,
                  nous vous rembourserons la totalité de son prix dans les meilleurs délais.
               </li>
            </ol>
         </li>
         <li>Images et dimension des produits
            <ol class="ml-3">
               <li>
                  Les images des Produits présentées ne sont données qu’à titre indicatif. Bien que nous
                  mettions tous les moyens en œuvre pour afficher les couleurs avec exactitude, nous ne
                  pouvons garantir que votre ordinateur affichera les couleurs de manière exacte ou offrira
                  un rendu satisfaisant de la couleur des Produits. Les Produits qui vous sont livrés peuvent
                  être légèrement différents de ceux qui sont présentés sur les images.
               </li>
               <li>
                  Bien que nous mettions tous les moyens en œuvre pour être aussi précis que possible,
                  les dimensions indiquées, y compris les poids, et les capacités, ne sont qu’approximatives.
               </li>
            </ol>
         </li>
         <li>Prix des produits
            <ol class="ml-3">
               <li>Le prix de tout Produit est celui qui est indiqué, sauf en cas d’erreur manifeste.</li>
               <li>Le prix de tout Produit peut changer à tout moment, mais aucune modification n’aura
               d’incidence sur une commande déjà acceptée par nos services.</li>
               <li>Le prix des Produits s’entend HT mais hors frais de livraison, lesquels sont ajoutés si
               nécessaire au prix des Produits et indiqués dans le cadre du montant total dû au cours de la
               procédure de commande.
               </li>
               <li>
                  En raison du grand nombre de Produits présentés, il est toujours possible que, malgré
                  tous nos efforts, le prix de certains d’entre eux soit erroné. Nous vérifions en principe les
                  prix dans le cadre de notre procédure de traitement des commandes de façon que, dans le
                  cas où le prix d’un Produit est inférieur au prix indiqué, nous facturions le montant le plus
                  bas à l’expédition du Produit. Si le prix exact d’un Produit est supérieur au prix indiqué, nous
                  avons toute latitude pour vous contacter et vous demander vos instructions avant
                  d’expédier le Produit, ou pour rejeter votre commande et vous aviser de son rejet.
               </li>
               <li>
                  Si l’erreur de prix est manifeste et flagrante et que vous auriez vous-même pu vous
                  apercevoir facilement qu’il s’agissait d’une erreur, nous n’avons aucune obligation de vous
                  livrer le Produit au prix erroné (inférieur) et ce, même après envoi de l’acceptation de votre
                  commande.
               </li>
               <li>
                  En passant votre commande, vous mandatez expressément Nazarrugs.com pour
                  réaliser ou faire réaliser, en votre nom et pour votre compte, les éventuelles opérations de
                  dédouanement induites par votre achat et toutes les formalités qui y sont relatives auprès
                  des services des douanes en ce compris le paiement des droits et taxes et, le cas échéant,
                  les éventuelles demandes de remboursement de droits et taxes (pour, notamment, les
                  biens en retour). Ce mandat donné par vous implique pour Nazarrugs.com de réaliser ou
                  faire réaliser les opérations de dédouanement dans les règles de l’art et avec des
                  prestataires choisis, le client restant importateur et destinataire réel des produits
                  commandés au sens de la réglementation douanière.
               </li>
            </ol>
         </li>
         <li>Comment payer
            <ol class="ml-3">
               <li>Nous acceptons les modes de paiement indiqués. Les Produits et les frais de livraison
               applicables doivent nous être réglés avant la livraison des Produits.</li>
               <li>Nous acceptons les modes de paiement indiqués. Les Produits et les frais de livraison
               applicables doivent nous être réglés avant la livraison des Produits.</li>
            </ol>
         </li>
         <li>Livraison
            <ol class="ml-3">
               <li>Nous proposons un service de livraison avec les délais indiqués pour chaque Produit
               proposé. Nous attirons votre attention sur le fait que les délais de livraison indiqués sont des
               délais estimatifs.</li>
               <li>
                  Nous attirons votre attention sur le fait que nous ne livrons que les adresses situées en
                  France métropolitaine, Corse, Espagne, Portugal, Belgique, Allemagne, Italie.
               </li>
               <li>
                  Votre date d’expédition estimée vous sera indiquée dans une confirmation
                  d’expédition envoyée par e-mail. Cette date d’expédition correspond à la date à laquelle
                  nous pensons envoyer les Produits à notre partenaire de livraison. Bien que nous mettions
                  tous les moyens en œuvre pour que les Produits vous soient expédiés et livrés dans les
                  délais estimés, nous ne pouvons malheureusement garantir qu’ils ne seront pas affectés par
                  des problèmes imprévus liés à leur fabricant ou à nos partenaires de livraison. Si nous ne
                  sommes pas en mesure de respecter la date estimée d’expédition ou de livraison, nous
                  vous contacterons et vous communiquerons une nouvelle date estimée.
               </li>
               <li>
                  La livraison est effectuée au moment où nous notre prestataire livre les Produits à
                  l’adresse que vous nous avez indiquée. Si personne n’est présent à votre adresse pour
                  prendre livraison de la commande, notre prestataire vous laisserez un avis vous indiquant
                  comment procéder pour organiser une nouvelle livraison. Si, au bout de trois tentatives de
                  notre part, vous n’avez pas pris livraison de votre commande, nous considérerons le contrat
                  comme ayant été annulé à votre initiative.
               </li>
               <li>
                  Vous pouvez suivre à tout moment le statut de votre commande en cliquant sur le lien
                  d’expédition donné. Si vous avez des difficultés à trouver le statut de votre commande ou à
                  suivre son évolution, contactez notre équipe Service Client.
               </li>
            </ol>
         </li>
         <li>Risque et Propriété
            <ol class="ml-3">
               <li>La propriété des Produits vous est transférée dès lors que nous avons perçu
               l’intégralité de toutes les sommes dues pour les Produits, frais de livraison inclus.
               </li>
               <li>
                  Les Produits relèvent de votre responsabilité dès le moment où vous (ou un tiers autre
                  que le transporteur et indiqué par vous) prenez possession physique des Produits
               </li>
            </ol>
         </li>
         <li>Annulation et remboursement
            <ol class="ml-3">
               <li>
                  Toutes demandes de retour est géré par le Client. Nazar Rugs ne se tient pas
                  responsable de la gestion des retours.
               </li>
               <li>
                  Nazar Rugs se réserve le droit de refuser les retours et d’appliquer des pénalités d’un
                  montant de 20€ pouvant aller jusqu’au prix total du produit en cas de défaut volontaire.
               </li>
            </ol>
         </li>
         <li> Informations personnelles
            <ol class="ml-3">
               <li>Nous traitons les informations vous concernant conformément à notre Politique de
               confidentialité.</li>
            </ol>
         </li>
         <li>Responsabilités
            <ol class="ml-3">
               <li>Nous avons l’obligation légale de fournir des Produits qui sont conformes au contrat
               que nous avons passé avec vous.</li>
               <li>Nos Produits sont conçus pour un usage domestique et nous ne donnons aucune
               garantie concernant leur performance dans un environnement commercial. Notre
               responsabilité envers vous ne saura être engagée en cas de manque à gagner, de perte
               d’activité, d’interruption d’activité ou de perte d’opportunités</li>
               <li>Nos Produits sont conçus pour un usage domestique et nous ne donnons aucune
               garantie concernant leur performance dans un environnement commercial. Notre
               responsabilité envers vous ne saura être engagée en cas de manque à gagner, de perte
               d’activité, d’interruption d’activité ou de perte d’opportunités</li>
               <li>
                  Dans les limites prévues par la loi en vigueur, le montant maximum de la perte ou du
                  dommage dont nous serons responsables est limité au prix que vous avez payé pour le
                  Produit.
               </li>
               <li>
                  Nous ne saurons ni exclure ni limiter notre responsabilité dans les cas suivants : (a)
                  décès ou préjudice corporel causé par notre négligence ; (b) fraude ou déclarations
                  frauduleuses ; (c) responsabilité imposée par la Loi de 2015 relative aux droits des
                  consommateurs, dont l’exclusion ou la restriction de l’application n’est pas autorisée aux
                  termes de l’article 31 de la Loi de 2015 sur les droits des consommateurs ; et (d) produits
                  défectueux en vertu de la Loi de 1987 sur la protection des consommateurs.
               </li>
            </ol>
         </li>
         <li> Force majeur
            <ol class="ml-3">
               <li>
                  Notre responsabilité ne saura être mise en cause en cas d’inexécution ou de retard
                  d’exécution de nos obligations dans le cadre d’un contrat qui serait causé par des
                  évènements de force majeure, notamment par des catastrophes naturelles, incendies,
                  inondations, conditions météorologiques difficiles, explosions, guerres (déclarées ou non),
                  actes de terrorisme, actes des pouvoirs publics centraux ou locaux ou de tout autre
                  autorité compétente, étant entendu que : (a) nous prendrons toutes les mesures
                  raisonnables pour éviter ou minimiser l’inexécution ou le retard ; (b) en cas d’inexécution
                  de nos obligations, nous vous rembourserons tous les montants payés dans le cadre du
                  contrat concerné ; et (c) en cas de retard important, vous avez la faculté de nous informer
                  de votre décision d’annuler votre commande et nous vous rembourserons alors tous les
                  montants payés dans le cadre du contrat concerné.
               </li>
            </ol>
         </li>
         <li>Résolution et litige
            <ol class="ml-3">
               <li>
                  Si un litige vous oppose à nous, concernant le contrat que nous avons passé avec
                  vous, veuillez dans un premier temps nous contacter à l’adresse sav@nazarrugs.fr et tenter
                  de résoudre ce litige avec nous de manière informelle. Vous pouvez également nous écrire
                  à l’adresse suivante : Nazar Rugs 1625 route de Sandillon 45560 Saint Denis en Val.
               </li>
               <li>
                  Pour le cas improbable où nous ne parviendrions pas à résoudre le litige de manière
                  informelle, nous attirons votre attention sur le fait que l’UE propose une plate-forme de
                  résolution en ligne des litiges sur laquelle les consommateurs de l’UE peuvent exposer les
                  litiges qui résultent d’achats en ligne, et dont l’adresse est la suivante : //ec.europa.eu/odr.
                  Vous avez par ailleurs la possibilité de résoudre le litige en intentant une action en justice.
               </li>
            </ol>
         </li>
         <li>Autonomie des dispositions
            <ol class="ml-3">
               <li>Chacune des dispositions des présentes Conditions de Vente fonctionne séparément.
               Si un tribunal ou une autre autorité compétente décide que l’une des dispositions de ces
               Conditions de Vente est illégale ou inapplicable, les autres dispositions resteront en
               vigueur</li>
            </ol>
         </li>
         <li>Mise à jour des présentes conditions de vente
            <ol class="ml-3">
               <li>
                  Nous pouvons modifier ou mettre à jour les présentes Conditions de Vente à tout
                  moment pour diverses raisons, notamment en cas de : (a) modification du mode de
                  fonctionnement de notre organisation ; (b) modification des exigences légales ou
                  réglementaires auxquelles nous devons nous conformer ; ou (c) modification des modes
                  de paiement que nous acceptons. Toutefois, chacune de vos commandes de Produits sera
                  régie par les modalités publiées sur notre site au moment de la commande.
               </li>
            </ol>
         </li>
         <li>Droit des tiers
            <ol class="ml-3">
               <li>Tout Contrat conclu entre vous et nous ne l’est qu’entre vous et nous. Aucun tiers
               n’aura le droit de se prévaloir de ses termes.</li>
            </ol>
         </li>
         <li>Cession de vos droits
            <ol class="ml-3">
               <li>
                  Nous pouvons céder nos droits et obligations prévus dans le cadre du contrat conclu
                  avec vous à une autre organisation et nous mettrons tous les moyens en œuvre pour vous
                  en informer par écrit si cela se produit, sans que cela n’affecte vos droits ou nos obligations
                  prévus dans le cadre du contrat.
               </li>
            </ol>
         </li>
         <li>Droit applicable et compétence
            <ol class="ml-3">
               <li>Les présentes Conditions de Vente sont régies par le droit français. Cela signifie qu’un
               contrat portant sur l’achat de Produits sur notre site et tout litige ou action qui lui ferait
               suite ou lui serait lié sera régi par le droit français.</li>
               <li>Les présentes Conditions de Vente sont régies par le droit français. Cela signifie qu’un
               contrat portant sur l’achat de Produits sur notre site et tout litige ou action qui lui ferait
               suite ou lui serait lié sera régi par le droit français.</li>
            </ol>
         </li>
         <li> Vous contacter
            <ol class="ml-3">
               <li>
                  Si nous devons vous contacter ou vous informer de quelque chose par écrit, nous le
                  ferons par e-mail ou par courrier affranchi à l’adresse communiquée dans votre
                  commande.
               </li>
            </ol>
         </li>
         <li> Nous contacter
            <ol class="ml-3">
               <li>
                  Si vous avez des questions concernant les présentes Conditions de Vente,
                  transmettez-les-nous par e-mail à l’adresse : sav@nazarrugs.fr ou contactez-nous par
                  téléphone au 0238432914 (Lun – Ven : 9 à 12h et de 13h30 à 16h30). Nous saurons vous
                  aider.
               </li>
            </ol>
         </li>
         <li>Votre compte et votre mot de passe
            <ol class="ml-3">
               <li>
                  Si vous créez un compte sur notre site, vous devez traiter vos informations de
                  connexion comme des informations confidentielles. Vous ne devez pas les communiquer à
                  autrui.
               </li>
               <li>
                  Nous avons le droit de désactiver un compte à tout moment si nous avons des raisons
                  de penser que vous avez manqué à l’une des modalités des présentes Conditions
                  d’Utilisation.
               </li>
               <li>
                  Si vous savez ou suspectez que quelqu’un d’autre que vous connaît vos informations
                  de connexion, vous devez nous en informer dans les meilleurs délais à l’adresse
                  sav@nazarrugs.fr.
               </li>
            </ol>
         </li>
         <li>Politique de notification et de retrait
            <ol class="ml-3">
               <li>
                  Si vous estimez que le contenu disponible sur le site :
                  (a) porte atteinte à vos droits ou aux droits d’un tiers que vous représentez ; où
                  (b) est contraire aux Règles de bon usage,
                  Veuillez-nous en informer immédiatement en utilisant la page contact de notre site.
               </li>
               <li>
                  Lorsque vous signalez du contenu, veuillez-nous communiquez dans votre message
                  les informations suivantes : (a) votre nom et vos coordonnées ; et (b) une déclaration
                  expliquant que vous estimez que le contenu au sujet duquel vous nous contactez : (i) porte
                  atteinte à vos droits ; (ii) porte atteinte aux droits d’un tiers que vous représentez ; ou (iii)
                  est contraire aux Règles de bon usage.
               </li>
               <li>
                  Nous prendrons les mesures que nous estimons adaptées en fonction de la nature du
                  contenu ainsi signalé, ce qui peut signifier ne prendre aucune mesure dans le cas où nous
                  estimons que le contenu signalé ne porte atteinte à aucun droit et n’est pas contraire aux
                  Règles de bon usage. Nous n’avons aucune obligation d’évoquer avec vous la démarche
                  que nous décidons d’adopter après votre signalement ni de vous en informer.
               </li>
            </ol>
         </li>
         <li>Propriété intellectuelle
            <ol class="ml-3">
               <li>
                  Nous sommes propriétaire ou titulaire de licence de tous les droits de propriété
                  intellectuelle associés à notre site et aux éléments qui y sont publiés. Ces éléments sont
                  protégés par les lois et les traités relatifs au droit d’auteur dans le monde entier. Tous ces
                  droits sont réservés. Nous vous autorisons à accéder à notre site pour votre usage
                  personnel uniquement. Toute autre utilisation de notre site ou de son contenu est interdite.
                  Cette interdiction concerne, notamment mais non limitativement, les agissements suivants :
                  (a) utilisation commerciale du contenu de notre site ;
                  (b) reproduction des noms, logos et marques de fabrique Nazar Rugs ou de tout autre
                  contenu disponible sur notre site ;
               </li>
               <li>
                  Si vous souhaitez faire des textes et des images présentés sur notre site, une utilisation
                  autre que celle qui est décrite ci-dessus, contactez-nous à l’adresse
                  communication@nazarrugs.fr.
               </li>
            </ol>
         </li>
         <li>Exclusion et responsabilité
            <ol class="ml-3">
               <li> L’accès à notre site est autorisé à titre temporaire et nous pouvons limiter ou mettre fin
               à l’accès à notre site à tout moment sans avis préalable. Nous déclinons toute
               responsabilité en cas d’indisponibilité de notre site à tout moment ou pendant quelque
               durée que ce soit.</li>
               <li>
                  Nous avons apporté le plus grand soin à la préparation du contenu de notre site.
                  Toutefois, nous déclinons toute responsabilité concernant les erreurs ou omissions ou les
                  problèmes techniques que vous pourriez y rencontrer. Si nous sommes informés de la
                  présence d’inexactitudes dans le contenu de notre site, nous tenterons de les corriger dès
                  que possible.
               </li>
               <li>
                  Si nous mettons en œuvre des efforts raisonnables pour que chacune des
                  informations présentées sur notre site soit exacte, ces informations ne sont assorties
                  d’aucune garantie ni condition de quelque nature que ce soit et le site est mis à votre
                  disposition « EN L’ÉTAT ». Nous ne sommes pas responsables des conséquences qui
                  résultent de votre dépendance au contenu de notre site.
               </li>
               <li>
                  Dans tous les cas, nous n’assumerons jamais de responsabilité concernant le Contenu
                  Utilisateur, et vous utilisez et vous fiez à ce Contenu Utilisateur exclusivement à vos risques
                  et périls.
               </li>
               <li>
                  Parce que notre site est proposé gratuitement, nous ne saurons en aucune manière
                  être tenus responsables des préjudices ou dommages (directs ou indirects) résultant de la
                  responsabilité délictuelle (y compris de la négligence), d’un manquement à une obligation
                  contractuelle ou légale ou encore (même s’ils étaient prévisibles) en lien avec l’utilisation
                  que vous faites de notre site ou des informations qui y sont présentées.
               </li>
               <li>
                  Si vous naviguez sur notre site en tant que consommateur, alors aucune disposition
                  des présentes Conditions d’Utilisation ni aucune autre disposition ne limite les droits légaux
                  du consommateur qui ne peuvent être modifiés par les présentes Conditions d’Utilisation.
               </li>
               <li>
                  Si vous naviguez sur notre site en tant que consommateur, alors aucune disposition
                  des présentes Conditions d’Utilisation ni aucune autre disposition ne limite les droits légaux
                  du consommateur qui ne peuvent être modifiés par les présentes Conditions d’Utilisation.
               </li>
            </ol>
         </li>
         <li>Modifications
            <ol class="ml-3">
               <li>Nous pouvons modifier les présentes Conditions d’Utilisation à tout moment en
               modifiant la présente page. Il vous appartient de contrôler cette page ponctuellement afin
               d’être informé(e) de toute modification apportée.</li>
            </ol>
         </li>
         <li>Autonomie des modalités
            <ol class="ml-3">
               <li>Si une modalité des présentes Conditions d’Utilisation est jugée non valable, les autres
               modalités resteront en vigueur dans les limites prévues par la loi.</li>
            </ol>
         </li>
         <li>Droit applicable et compétence
            <ol class="ml-3">
               <li>Les tribunaux français auront compétence non exclusive pour connaître de toute
               action qui ferait suite ou serait liée à une visite sur notre site bien que nous conservions le
               droit d’intenter une procédure à votre encontre pour manquement aux présentes
               Conditions d’Utilisation.</li>
            </ol>
         </li>
         <li>Feedback
            <ol class="ml-3">
               <li> Si vous souhaitez nous faire part de vos observations concernant notre site, veuillez
               nous contacter à l’adresse sav@nazarrugs.fr</li>
            </ol>
         </li>
      </ol>
   </section>
</template>

<style>
  ol {
    counter-reset: section;
    list-style-type: none;
  }
  li::before {
    counter-increment: section;
    content: counters(section, ".") " - ";
  }
  .first-list > li{
   font-weight: bold;
   margin-top: 1rem;
   font-size: 1.2rem;
  }
  .first-list > li > ol > li{
   font-weight:lighter;
   margin-top: 0.5rem;
   font-size: 1rem;
  }
</style>