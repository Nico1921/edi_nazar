<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import { HomeIcon,LightBulbIcon  } from '@heroicons/vue/24/solid';
const schema = new URL('../../../../images/AboutUs/schema.webp', import.meta.url).href;
var links = [{
        title: 'Accueil',
        link: '/',
        icon: HomeIcon,
        active: false
    },{
      title: 'A propos',
      link: '/about-us',
      icon: LightBulbIcon,
      active: true
}];

</script>
<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    // Using a render function
    layout: (h, page) => h(AuthenticatedLayout, () => child),

    // Using the shorthand
    layout: AuthenticatedLayout,
}
</script>
   
<template>
    <Head title="About Us" />
    <section class="container mx-auto px-7 mt-5">
        <Breadcrumbs :links="links" />
        <h1 class="font-semibold text-sm lg:text-xl sm:text-lg text-gray-800 text-center py-5">
            Drop Shipping - Moteur de croissance
        </h1>

        <div class="p-3 lg:text-lg text-sm">
                           <h2 class="lg:text-lg text-sm font-bold pb-4">Comment passer une commande ?</h2>
                           <p>
                               Cliquez sur l’onglet ORDERS puis ADD AN ORDER:
   Ensuite, renseignez tous les champs. Toutes ces informations nous servirons pour le transport ainsi que le suivi
   des commandes.
   Puis CONFIRM.
   Nos équipes se chargerons de vous donner dans les meilleurs délais un suivi à votre commande.
                           </p>
                       </div>
                       <div class="p-3 lg:text-lg text-sm">
                           <h2 class="lg:text-lg text-sm font-bold pb-4">L'onglet Products :</h2>
                           <p>
                               Sur cette onglet vous pouvez consulter l’état des stocks en temps réel. (le stock est mis à jour minimum 1 fois
   par jour).
   Vous pouvez également télécharger des photos, récupérer le descriptif technique de chaque collection, vérifier
   et consulter les codes SKU et EAN.
   Une recherche rapide est possible en inscrivant vos besoins dans l’encart approprié sous chaque titre.
                           </p>
                       </div>
                       <div class="p-3 lg:text-lg text-sm">
                           <h2 class="lg:text-lg text-sm font-bold pb-4">Shippings, qu'est ce que c'est ?</h2>
                           <p>
                               Pour pouvoir suivre les étapes de la livraison, après avoir passé commande dans l’onglet COMMANDES, nos
   équipes interviennent sur votre commande en indiquant les différentes étapes qu’aura subit celle-ci. Les
   messages affichés seront les suivants:
   En cours de validation: Vous venez de nous transmettre la ou les commande(s), celle-ci est en attente de
   validation par nos équipes.
   En attente de livraison: La commande a été validée par nos équipes, nous respectons le délai de 24h de sécurité (en cas d’annulation du client respectant ses droits de rétractation) avant l’expédition de la commande.
   En cours de livraison: votre commande a été expédiée de notre dépôt pour une livraison chez le client sous
   48/72 h.
   Livré: le colis a été livré à la date indiquée
                           </p>
                       </div>
                       <div class="p-3 lg:text-lg text-sm">
                           <h2 class="lg:text-lg text-sm font-bold pb-4">Drop Shipping - Moteur de croissance</h2>
                           <p>
                               Afin de relever les défis du commerce électronique en croissance constante et de plus en plus importante et ainsi rester
   compétitif avec une croissance saine et continue, des investissements considérables et risqués sont nécessaires, qui limitent
   cependant énormément la liquidité.
   Le préfinancement des marchandises pour une large gamme de produits, l'entreposage, les employés pour l'expédition des
   marchandises et l'assistance ne sont que quelques-uns des obstacles coûteux, mais cela ne garantit pas à lui seul le succès
   économique. Cela ne passe que par les piliers du marketing, des relations publiques et de la fidélisation de la clientèle, qui
   mobilisent à nouveau des coûts et des ressources.
   La liaison du capital aux biens et à la structure a généralement un effet négatif sur une croissance rapide et surtout peu risquée.
                           </p>
                       </div>

        <div class="p-3 flex flex-col justify-center lg:text-lg text-sm">
            <h2 class="lg:text-lg text-sm font-bold pb-4">La solution drop shipping est le chemin du succès - Livraison directe chez le client :</h2>
            <img :src="schema" alt="Schéma BtoB" />
            <p>Nazar Rugs DropShipping permet aux e-commerçants et à nos partenaires de proposer une large gamme de produits (environ 3 000 références) avec une disponibilité immédiate sans avoir à les
préfinancer. Chaque marchand e-commerce peut également bénéficier de notre modèle dropshipping avec un concept adapté. Le capital qui n'est pas immobilisé peut être investi, entre autres,
dans le marketing et donc la croissance.</p>

        <p>
            En étroite collaboration entre le partenaire et Nazar Rugs, le partenaire vend les marchandises à ses clients finaux et Nazar Rugs les envoie directement de son entrepôt au client final - le concept
            est illustré sous une forme simplifiée (voir schéma ci-dessus). La croissance rapide du marché en ligne et le potentiel qui découle de la livraison directe avec des partenaires solides ont conduit le
            groupe Nazar à la conviction que pour relier les domaines d'activité du commerce de gros, du commerce fixe et du commerce en ligne de manière efficace et lucrative. Le groupe Nazar, qui avec
            plus de 12 ans d'expériences est l'un des leaders du marché du tapis en France, a créé la filiale Nazar Rugs DropShipping spécifiquement à cet effet. Avec le savoir-faire en matière de processus et
            les 3 000 références de produits innovants des marques du groupe Nazar (Nazar Rugs et Hello Tapis), le groupe constitue la base optimale du concept Nazar Rugs DropShipping. Au cours d'une
            phase de développement et d'optimisation de 18 mois, les systèmes techniques nécessaires à l'échange électronique automatisé de données ont d'abord été développés par les spécialistes
            informatiques de Nazar. Nos experts en marketing, chefs de produits et designers ont créé toutes les données spécifiques aux produits, des photos professionnelles détaillées et des descriptions
            textuelles émotionnelles. Celles-ci sont absolument nécessaires au commerce en ligne afin de répondre pleinement aux attentes élevées des clients finaux lors de la réception de leur commande.
            Depuis le début de l'activité opérationnelle, la réponse a été exclusivement positive et les demandes de connexion de nouveaux partenaires ne cessent d'augmenter. Les partenaires de Nazar Rugs
            comprennent à la fois des clients existants du groupe Nazar du commerce spécialisé en ameublement ainsi que des chaînes de quincailleries bien connues, des sociétés de vente par
            correspondance, des discounters, des détaillants. En se concentrant sur leurs propres compétences de base, une situation gagnant-gagnant est créée pour les deux partenaires, ce qui augmente
            les ventes, les retours et l'efficacité.
        </p>
        </div>

        <div class="p-3 flex flex-col justify-center lg:text-lg text-sm">
            <h2 class="lg:text-lg text-sm font-bold pb-4 text-center">Les avantages inévitables du Drop Shipping</h2>
            <p>
                Afin que nos partenaires puissent commercialiser les produits avec succès, Nazar Rugs vous fournit toutes les données pertinentes sous forme numérique.
                Les données ont été préparées par les informaticiens dans différentes langues de manière à ce que le partenaire puisse facilement intégrer les produits dans
                sa boutique et dans son système existant sans grand effort. La disponibilité actuelle des marchandises est transmise automatiquement plusieurs fois par
                jour. Les bons de commande, les commandes et les informations de suivi colis sont visibles via l’onglet « suivi ». Le prélèvement et l'expédition au client final
                s'effectuent directement depuis notre entrepôt à l'aide des informations pertinents fournis par le partenaire, manuellement ou en import par fichier excel. Le
                client final reçoit sa livraison au nom du partenaire, sans que ce dernier n'ait jamais à entrer physiquement en contact avec la marchandise. Une équipe de
                service formée et expérimentée dans le secteur est à la disposition des partenaires et, s'ils le souhaitent, de leurs clients finaux pour toute question. Tout
                retour peut également être traité par Nazar Rugs, de sorte que l'effort réel du partenaire est réduit au minimum. Un taux de livraison de plus de 98 % pour
                environ 3 000 références et un nombre extrêmement faible de retours soulignent une fois de plus le professionnalisme et le succès qui en résulte. Les
                entreprises qui continuent à ne pas utiliser le grand potentiel du commerce électronique ratent clairement l'occasion d'augmenter leurs ventes, de gagner de
                nouveaux clients et de s'établir durablement sur le marché.
            </p>
        </div>
    </section>
</template>
   