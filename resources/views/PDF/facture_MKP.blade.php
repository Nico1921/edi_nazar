@php
 date_default_timezone_set('Europe/Paris'); 

 function date_convert($date, $toBase=false){
	if ($toBase){
		if(count(explode('/',$date))<3) return $date;
		list($d, $m, $y) = explode('/',$date);
		return "$y-$m-$d";
	}
	else {
		if(count(explode('-',$date))<3) return $date;
		list($y, $m, $d) = explode('-',$date);
		return "$d/$m/$y";
	}
}

function aff_type_paiement($payment_type=''){
	if($payment_type==1)
		return 'Ch&egrave;que';
	elseif($payment_type==2)
		return 'Virement';
	elseif($payment_type==3)
		return 'Paypal';
	elseif($payment_type==4)
		return 'Carte cr&eacute;dit';
	elseif($payment_type==5)
		return 'Cash';
	elseif($payment_type==6)
		return 'Avoir';
	else
		return 'Error';
}
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full overflow-y-auto">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <title>{{ config('app.name', 'Nazar EDI') }}</title>

        <!-- Fonts -->
        
        <style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0cm 0cm;
            }
        
            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 1cm;
                margin-left: 1cm;
                margin-right: 1cm;
                margin-bottom: 3cm;
            }
        
            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 2.75cm;
            }
        </style>
    </head>
    <body>

        <footer>
            <div style="text-align: center; color:#000; line-height:4mm; padding-top:2mm; font-size:3mm;">
                Tout règlement postérieur à la date d'échéance donnera lieu à l'application d'une pénalité de retard égale à trois fois le taux d'intérêt légal
            </div>
            <div style="text-align: center; color:#000; line-height:4mm; padding-top:2mm; font-size:3mm;">
                ainsi qu'une indemnité forfaitaire pour frais de recouvrement de 40 euros.
            </div>
            <div style="text-align: center; color:#000; line-height:4mm; padding-top:2mm; font-size:3mm;">
                SAS NAZAR RUGS - 1625 Route de Sandillon, - 45 560 Saint Denis en Val - Tel : 02 38 43 29 14 - Mail : tapis.nazar@gmail.com - www.nazarrugs.com
            </div>
            <div style="text-align: center; color:#000; line-height:4mm; padding-top:2mm; font-size:3mm;">
                Au capital de 200 000€ - RCS ORLEANS 538 175 498 - SIRET : 538 175 498 000 46 - TVA intracommunautaire : FR 15538175498 
            </div>
        </footer>
        <main>
        <table cellspacing="0" style="width: 100%; text-align: left; font-size: 12px;">
            <tr>
                <td style="width: 30%;">
                    <img src="{{ Vite::asset('resources/images/Logo/nazar2019.jpg') }}" alt="TAPIS NAZAR" style="width: 200px">
                </td>
                <td style="width: 70%;vertical-align:top;">
                    <table cellspacing="0" style="width:100%; padding:10px; border:solid 1px #000">
                        <tr>
                            <td style="width: 50%;font-size:12pt;padding:10px;">
                                <table cellspacing="0" cellpadding="0" style="width: 260px;">
                                    <tr>
                                        <td style="font-size:10pt">N&deg; TVA : {{ $user->client->tva_intra }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:10pt;">
                                            @if ($facture->gen_facture == 1)
                                                @php echo 'Date de facture : '.date_convert($facture->date_facture, false) @endphp
                                            @else 
                                                @php echo 'Date d\'&eacute;dition : '.date_convert($facture->date_proforma, false) @endphp
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:10pt; padding-top:10px">
                                            @php
                                                echo 'N&deg; Devis : '.$facture->num_proforma;
                                                if(!empty($facture->date_livraison) && $facture->date_livraison !='0000-00-00' && $facture->gen_facture == 1){
                                                    echo '<br />Date de livraison : '.date_convert($facture->date_livraison, false);
                                                }
                                                if($facture->gen_facture == 1){
                                                    echo '<br />N&deg; Facture : '.$facture->num_facture;
                                                }
                                            @endphp
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 50%;padding:10px;vertical-align:top;">
                                <table cellspacing="0" cellpadding="0" style="width: 258px; font-size:11pt">
                                    <tr>
                                        <td style="font-size:10pt; width: 158px">
                                            <b>{{ $user->client->nom_societe }}</b><br />
                                            {{ $user->client->adresse1 }}
                                            @if(!empty($user->client->adresse2))
                                                <br /> {{ $user->client->adresse2 }}
                                            @endif
                                            @if(!empty($user->client->adresse3))
                                                <br /> {{ $user->client->adresse3 }}
                                            @endif
                                            <br />{{ $user->client->code_postal }} {{ $user->client->ville }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-size:12pt; padding-top:10pt; height:70px">
                                <table cellspacing="0" cellpadding="0" style="width:540px; color:#006;padding-left:10px;">
                                    <tr>
                                        <td style="font-size:10pt; color:#000; vertical-align:text-top;">
                                            @if(!empty($commande->num_commande_interne))
                                                <br />N&deg; Commande client : {{$commande->num_commande_interne}}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:10pt; color:#999; vertical-align:text-bottom; width:520px;">@php echo nl2br($facture->observation); @endphp</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table cellspacing="0" cellpadding="0" style="width: 100%; margin-top:20px;">
            <tr>
                <td style="vertical-align:top; padding-bottom:10px">
                    <table cellspacing="0" style="width: 100%; border-bottom: solid 1px black; border-top: solid 1px black; text-align: left; font-size: 9pt;">
                        <tr>
                            <th style="width: 10%; padding:2px; text-align:center">Quantit&eacute;</th>
                            <th style="width: 30%; padding:2px; text-align:center">D&eacute;signation de l'article</th>
                            <th style="width: 12%; padding:2px; text-align:center">Taille en cm</th>
                            <th style="width: 14%; padding:2px; text-align:center">Code EAN</th>
                            <th style=" @php echo ($commandeListCount > 0 ? 'width: 10%' : 'width: 16%'); @endphp; padding:2px; text-align:center">Prix pi&egrave;ce</th>
                            @if($commandeListCount > 0)
                                <th style="width: 7%; padding:2px;">% Remise</th>
                                <th style="width: 7%; padding:2px;">Mnt Remise</th>
                            @endif
                            <th style="@php echo ($commandeListCount > 0 ? 'width: 10%' : 'width: 18%'); @endphp; padding:2px; text-align:right">TOTAL</th>
                        </tr>
                    </table>
                </td>
            </tr>
            @php
                $TOTAL_QTE = 0;
                $TOTAL_POIDS = 0;
                $TOTAL_M2 = 0;
                $lignes = 0;
                $acompte_ttc = $facture->montant_ttc - $facture->montant_due_ttc; 
                $montant_ht = $facture->montant_ht + $commandeListSum;
            @endphp

            @if(!empty($produits))
                @foreach($produits as $val)
                    @php
                        $TOTAL_QTE = $TOTAL_QTE + $val->commande->quantite;
                        $TOTAL_POIDS = $TOTAL_POIDS + $val->poids;
                        $TOTAL_M2 = $TOTAL_M2+ $val->superficie;
                        $gencode =  $val->commande->gencode;
                        $montant_remise_ht = ($val->commande->prix_ht - $val->commande->prix_remise_ht) *$val->commande->quantite;
                    @endphp
                    <tr style="@php echo ($lignes%2 ? 'background:#fff' : 'background:#ccc' ); @endphp">
                        <td style="vertical-align:top">
                            <table cellspacing="0" style="width: 100%; text-align: left; font-size: 9pt;">
                                <tr>
                                    <td style="width: 10%; padding:2px; text-align:center">{{ $val->commande->quantite }}</td>
                                    <td style="width: 30%; padding:2px; text-align:center">{{ $val->gamme->nom_gamme }} - {{ $val->produit->design->nom_design}} {{ $val->produit->couleur->nom_couleur}}</td>
                                    <td style="width: 12%; padding:2px; text-align:center">{{ $val->produit->dimension->largeur }} x {{ $val->produit->dimension->longueur }} cm</td>
                                    <td style="width: 14%; padding:2px; text-align:center">{{ $gencode }}</td>
                                    @if($val->commande->remise =='100.00')
                                        <td colspan="3" style="width: 24%; padding:2px;">*** Offre sp&eacute;ciale ***</td>
                                    @else
                                        <td style="@php echo ($commandeListCount > 0 ? 'width: 10%' : 'width: 16%'); @endphp; padding:2px; text-align:center">@php echo number_format($val->commande->prix_ht, 2, ',', ' '); @endphp &euro;</td>
                                        @if($commandeListCount > 0)
                                            <td style="width: 7%; padding:2px;">@php number_format($val->commande->remise, 2, ',', ' ') @endphp %</td>
                                            <td style="width: 7%; padding:2px;">@php number_format($montant_remise_ht, 2, ',', ' ') @endphp</td>
                                        @endif
                                        <td style="@php echo ($commandeListCount > 0 ? 'width: 10%' : 'width: 18%'); @endphp; padding:2px; text-align:right">@php echo number_format($val->commande->prix_total_ht, 2, ',', ' '); @endphp &euro;</td>
                                    @endif
                                </tr>
                                @if(!empty($val->commande->note))
                                    <tr>
                                        <td colspan="7" style="padding:2px; padding-bottom:0; font-size:8pt; font-style:italic">@php echo $val->commande->note @endphp</td>
                                    </tr>
                                @endif
                            </table></td></tr>
                    @php $lignes++ @endphp
                @endforeach
            @endif
            <tr>
                <td style="vertical-align:top; padding-top:10px">
                    <table cellspacing="0" style="width: 100%; border-bottom: solid 1px black; border-top: solid 1px black; text-align: left; font-size: 9pt;">
                        <tr>
                            <td style="width: 33.33%; padding:2px">Total = {{$TOTAL_QTE}} produit{{ ($TOTAL_QTE > 1 || $TOTAL_QTE != "1"? "s" : "") }}</td>
                            <td style="width: 33.33%; padding:2px">Poids total (en Kg) : {{ $TOTAL_POIDS }}</td>
                            <td style="width: 33.33%; padding:2px">Total en m2 : {{ $TOTAL_M2 }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table cellspacing="0" style="width: 100%; margin-top:10px; text-align: center; font-size: 7pt;">
            <tr>
                <td rowspan="2" style="width: 60%; padding:5px; vertical-align:top">
                    @if($facture->interne == 1)
                        <table cellspacing="0" style="width: 75%; margin-top:10px; text-align: center; font-size: 7pt; border:1px solid black">
                            <tr>
                                <td colspan="6" style="border-bottom:solid 1px black">
                                    <table width="99%" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td style="padding:5px;">Titulaire du compte :</td>
                                            <td style="padding:5px;">{{ $organisme->owner_bank }}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" style="border-bottom:solid 1px black">
                                    <table width="99%" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td style="padding:5px;">Domiciliation :</td>
                                            <td style="padding:5px;">{{ $organisme->domiciliation_bank }}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding:5px; border-bottom:solid 1px black; border-right:solid 1px black">Code Banque</td>
                                <td colspan="1" style="padding:5px; border-bottom:solid 1px black; border-right:solid 1px black">Code Guichet</td>
                                <td colspan="2" style="padding:5px; border-bottom:solid 1px black; border-right:solid 1px black">Num&eacute;ro de Compte</td>
                                <td colspan="1" style="padding:5px; border-bottom:solid 1px black;">Cl&eacute; RIB</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding:5px; border-right:solid 1px black">{{ $organisme->bank_code }}</td>
                                <td colspan="1" style="padding:5px; border-right:solid 1px black">{{ $organisme->branch_code }}</td>
                                <td colspan="2" style="padding:5px; border-right:solid 1px black">{{ $organisme->account_bank }}</td>
                                <td colspan="1" style="padding:5px;">{{ $organisme->key_digits }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" style="border-top:solid 1px black">
                                    <table width="99%" cellspacing="0" cellpadding="3">
                                        <tr>
                                            <td style="width:67%;">IBAN : {{ $organisme->iban }}</td>
                                            <td style="width:33%;">SWIFT : {{ $organisme->swift_bic }}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    @else
                        <table cellspacing="0" style="width: 99%; margin-top:10px; text-align: center; font-size: 8pt; border:1px solid black">
                            <tr>
                                <td>
                                    <table width="99%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td style="padding:5px; font-size: 7pt">
                                                Pour &ecirc;tre lib&eacute;ratoire, le r&egrave;glement de cette facture doit &ecirc;tre libell&eacute; et adress&eacute; &agrave; :<br />
                                                BPCE FACTOR<br />
                                                10-12 avenue Winston Churchill<br />
                                                94676 Charenton-le-Pont Cedex - T&eacute;l : 01 58 32 80 00<br />
                                                RIB : 30007 00011 00010500791 36 - Domiciliation : NATIXIS Paris<br />
                                                IBAN : FR76 3000 7000 1100 0105 0079 136<br />
                                                SWIFT CODE ( BIC ) : NATX FR PP XXX<br />
                                                N&deg; ICS de BPCE FACTOR : FR57ZZZ483693<br />
                                                BPCE FACTOR a acquis notre cr&eacute;ance par voie de subrogation dans le cadre d'un contrat d'affacturage.<br />
                                                BPCE FACTOR devra &ecirc;tre avis&eacute;e de toute r&eacute;clamation.
                                                <!--
                                                Pour &ecirc;tre lib&eacute;ratoire, votre r&egrave;glement doit &ecirc;tre effectu&eacute; directement<br />&agrave; l’ordre de Cr&eacute;dit Agricole Leasing &amp; Factoring<br />12 place des Etats-Unis – CS 20001 – 92548 MONTROUGE CEDEX - France,<br />qui le reçoit par subrogation dans le cadre d’un contrat d’affacturage<br />et derva &ecirc;tre avis&eacute; de toute r&eacute;clamation relative &agrave; cette cr&eacute;ance.
                                                -->
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    @endif
                </td>
                <td style="width: 40%; vertical-align:top; padding-top:15px">
                    <table cellspacing="0" style="width: 100%; font-size: 10pt; background: #FFF; border:1px solid black;">
                        @if($commandeListCount > 0)
                            <tr>
                                <td style="width:50%; padding-left:5px; text-align:left; background: #FFF;">Commande HT</td>
                                <td style="width:50%; padding-right:5px; text-align:right; background: #FFF;">@php echo number_format($montant_ht, 2, ',', ' '); @endphp &euro;</td>
                            </tr>
                        @else
                            <tr>
                                <td style="width:50%; padding-left:5px; text-align:left; background: #FFF;">Commande HT</td>
                                <td style="width:50%; padding-right:5px; text-align:right;background: #FFF;">@php echo number_format($facture->montant_ht, 2, ',', ' '); @endphp &euro;</td>
                            </tr>
                        @endif
                        @if(!empty($facture->montant_port_ht) && $facture->montant_port_ht !='0.00')
                            <tr>
                                <td style="width:50%; padding-left:5px; text-align:left; background: #FFF;">Frais de port HT</td>
                                <td style="width:50%; padding-right:5px; text-align:right; background: #FFF;">@php echo number_format($facture->montant_port_ht, 2, ',', ' '); @endphp &euro;</td>
                            </tr>
                        @endif
                        @if(!empty($facture->commission_ht) && $facture->commission_ht !='0.00')
                            <tr>
                                <td style="width:50%; padding-left:5px; text-align:left; background: #FFF;">Commission HT</td>
                                <td style="width:50%; padding-right:5px; text-align:right; background: #FFF;">@php echo '-'.number_format($facture->commission_ht, 2, ',', ' '); @endphp &euro;</td>
                            </tr>
                        @endif
                        @if(!empty($facture->abonnement_ht)  && $facture->abonnement_ht !='0.00')
                            <tr>
                                <td style="width:50%; padding-left:5px; text-align:left; background: #FFF;">Abonnement HT</td>
                                <td style="width:50%; padding-right:5px; text-align:right; background: #FFF;">@php echo '-'.number_format($facture->abonnement_ht, 2, ',', ' '); @endphp &euro;</td>
                            </tr>
                        @endif
                        @if(!empty($facture->remboursement_ht) && $facture->remboursement_ht !='0.00')
                            <tr>
                                <td style="width:50%; padding-left:5px; text-align:left; background: #FFF;">Remboursement HT</td>
                                <td style="width:50%; padding-right:5px; text-align:right; background: #FFF;">@php echo '-'.number_format($facture->remboursement_ht, 2, ',', ' '); @endphp &euro;</td>
                            </tr>
                        @endif
                        @if($commandeListCount > 0)
                            <tr>
                                <td style="width:50%; padding-left:5px; text-align:left; background: #FFF;">Total remise HT</td>
                                <td style="width:50%; padding-right:5px; text-align:right; background: #FFF;">@php echo number_format($commandeListSum, 2, ',', ' '); @endphp &euro;</td>
                            </tr>
                        @endif
                        <tr>
                            <td style="width:50%; padding-left:5px; text-align:left; background: #FFF;">TOTAL HT</td>
                            <td style="width:50%; padding-right:5px; text-align:right; background: #FFF;">@php echo number_format($facture->total_ht, 2, ',', ' '); @endphp &euro;</td>
                        </tr>
                        <tr>
                            <td style="width:50%; padding-left:5px; text-align:left; background: #FFF;">TVA @php echo number_format($facture->taux_tva, 2, ',', ' '); @endphp % @php echo ($facture->taux_tva =='0.00' ? '*' : ''); @endphp</td>
                            <td style="width:50%; padding-right:5px; text-align:right; background: #FFF;">@php echo number_format($facture->montant_tva, 2, ',', ' '); @endphp &euro;</td>
                        </tr>
                        <tr>
                            <td style="width:50%; padding-left:5px; padding:2; text-align:left; background: #FFF; color:#006; font-size:12pt"><b>TOTAL TTC</b></td>
                            <td style="width:50%; padding-right:5px; text-align:right; padding:2; background: #FFF; color:#006; font-size:12pt">@php echo '<b>'.number_format($facture->montant_ttc, 2, ',', ' ').' &euro;</b>'; @endphp</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        @if($paymentCount > 0)
            <table cellspacing="0" style="width: 100%; margin-top:10px; text-align: center; font-size: 11pt;">
                <tr>
                    <td rowspan="2" style="width: 69%; padding:5px; vertical-align:top">
                        <table cellspacing="0" style="width: 99%; margin-top:10px; text-align: left; font-size: 9pt;">
                            <tr>
                                <td>
                                    <table width="99%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td style="padding:5px">
                                                @if(!empty($payment) && $paymentCount > 0)
                                                    <u>Paiement(s) :</u><br /><br />
                                                    @foreach($payment as $valPayment)
                                                        @if($valPayment->payment_type == '1')
                                                                @php
                                                                sprintf('- %s %s %s %s %s&euro;<br />',
                                                                date_convert($valPayment->date_payment),
                                                                aff_type_paiement($valPayment->payment_type),
                                                                $valPayment->nature,
                                                                $valPayment->transaction,
                                                                number_format($valPayment->amount_ttc, 2, ',', ' '));
                                                                @endphp
                                                        @else
                                                            @php
                                                            echo sprintf('- %s %s %s&euro;<br />',
                                                                date_convert($valPayment->date_payment),
                                                                aff_type_paiement($valPayment->payment_type),
                                                                number_format($valPayment->amount_ttc, 2, ',', ' '));
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 30%; vertical-align:top; padding-top:15px">
                        <table cellspacing="0" style="width: 100%; font-size: 10pt; background: #FFF; border:1px solid black;">
                            <tr>
                                <td style="width:50%; text-align:left; background: #FFF;">Acompte TTC</td>
                                <td style="width:50%; text-align:right; background: #FFF;">@php echo number_format($acompte_ttc, 2, ',', ' '); @endphp &euro;</td>
                            </tr>
                            @if($facture->montant_due_ttc >0)
                                <tr>
                                    <td style="width:50%; text-align:left; font-weight:bold; background: #FFF; color:#006; font-size:11pt">Reste &agrave; payer</td>
                                    <td style="width:50%; text-align:right; font-weight:bold; background: #FFF; color:#006; font-size:12pt">@php echo number_format($facture->montant_due_ttc, 2, ',', ' '); @endphp &euro;</td>
                                </tr>
                            @else
                                <tr>
                                    <td style="width:50%; text-align:left; font-weight:bold; background: #FFF; color:#006; font-size:11pt">Reste &agrave; payer</td>
                                    <td style="width:50%; text-align:right; font-weight:bold; background: #FFF; color:#006; font-size:12pt">@php echo number_format($facture->montant_due_ttc, 2, ',', ' '); @endphp &euro;</td>
                                </tr>
                            @endif
                        </table>
                    </td>
                </tr>
            </table>
        @endif
        </main>
    </body>
</html>
