<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whois extends Model
{
    // use HasFactory;
    protected $output = [];
    protected $statuses = [];

    protected $whois_servers = [
    	'ac'	=> 'whois.nic.ac',
		'ad'	=> 'whois.ripe.net',
		'ae'	=> 'whois.aeda.net.ae',
		'aero'	=> 'whois.aero',
		'af'	=> 'whois.nic.af',
		'ag'	=> 'whois.nic.ag',
		'ai'	=> 'whois.ai',
		'al'	=> 'whois.ripe.net',
		'am'	=> 'whois.amnic.net',
		'as'	=> 'whois.nic.as',
		'asia'	=> 'whois.nic.asia',
		'at'	=> 'whois.nic.at',
		'au'	=> 'whois.aunic.net',
		'aw'	=> 'whois.nic.aw',
		'ax'	=> 'whois.ax', 
		'az'	=> 'whois.ripe.net',
		'ba'	 => 'whois.ripe.net',
		'bar'	 => 'whois.nic.bar',
		'be'	 => 'whois.dns.be',
		'berlin' => 'whois.nic.berlin',
		'best'   => 'whois.nic.best',
		'bg'     => 'whois.register.bg',
		'bi'     => 'whois.nic.bi',
		'biz'    => 'whois.neulevel.biz',
		'bj'     => 'www.nic.bj',
		'bo'     => 'whois.nic.bo',
		'br'     => 'whois.nic.br',
		'br.com' => 'whois.centralnic.com',
		'bt'     => 'whois.netnames.net',
		'bw'     => 'whois.nic.net.bw',
		'by'     => 'whois.cctld.by',
		'bz'     => 'whois.belizenic.bz',
		'bzh'    => 'whois-bzh.nic.fr',
		'cy'	 => '',
		'ca'	 => 'whois.cira.ca',
		'cat'    => 'whois.cat',
		'cc'	 => 'whois.nic.cc',
		'cd'     => 'whois.nic.cd',
		'ceo'    => 'whois.nic.ceo',
		'cf'     => 'whois.dot.cf',
		'ch'     =>  'whois.nic.ch', 
		'ci'	 => 'whois.nic.ci',
		'ck'     => 'whois.nic.ck',
		'cl'	 => 'whois.nic.cl',
		'cloud'	 => 'whois.nic.cloud',
		'club'	 => 'whois.nic.club',
		'cn'	 => 'whois.cnnic.net.cn',
		'cn.com' => 'whois.centralnic.com',
		'co'	 => 'whois.nic.co',
		'co.nl'  => 'whois.co.nl',
		'com' 	 =>'whois.verisign-grs.com',
		'es'	 => '',
		'fj'	 => 'whois.usp.ac.fj',
		'fm'     => 'http://www.dot.fm/query_whois.cfm?domain={domain}&tld=fm',
		'jobs'	 => 'jobswhois.verisign-grs.com',
		'ke'	 => 'kenic.or.ke',
		'la'	 => 'whois.centralnic.net',
		'gr'	 => '',
		'gs'     => 'http://www.adamsnames.tc/whois/?domain={domain}.gs',
		'gt'	 => 'http://www.gt/Inscripcion/whois.php?domain={domain}.gt',
		'me'	 => 'whois.meregistry.net',
		'mobi'	 => 'whois.dotmobiregistry.net',
		'ms'     => 'http://www.adamsnames.tc/whois/?domain={domain}.ms',
		'mt'	 => 'http://www.um.edu.mt/cgi-bin/nic/whois?domain={domain}.mt',
		'nl'	 => 'whois.domain-registry.nl',
		'na'     => 'whois.na-nic.com.na',
		'name' 	 => 'whois.nic.name',
		'nc' 	 => 'whois.nc',
		'net'    => 'whois.verisign-grs.com',
		'nf' 	 => 'whois.nic.cx',
		'ng'     => 'whois.nic.net.ng',
		'nl' 	 => 'whois.domain-registry.nl',
		'no' 	 => 'whois.norid.no',
		'no.com' => 'whois.centralnic.com',
		'nu' 	 => 'whois.nic.nu',
		'nz'     => 'whois.srs.net.nz',
		'ly'	 => 'whois.nic.ly',
		'pe'	 => 'kero.rcp.net.pe',
		'pr'	 => 'whois.uprr.pr',
		'pro'	 => 'whois.registry.pro',
		'sc'     => 'whois2.afilias-grs.net',
		'tc'     => 'http://www.adamsnames.tc/whois/?domain={domain}.tc',
		'tf'     => 'http://www.adamsnames.tc/whois/?domain={domain}.tf',
		've'	 => 'whois.nic.ve',
		'vg'     => 'http://www.adamsnames.tc/whois/?domain={domain}.vg',
		// Second level
		'net.au' => 'whois.aunic.net',
		'ae.com' => 'whois.centralnic.net',
		'br.com' => 'whois.centralnic.net',
		'cn.com' => 'whois.centralnic.net',
		'de.com' => 'whois.centralnic.net',
		'eu.com' => 'whois.centralnic.net',
		'hu.com' => 'whois.centralnic.net',
		'jpn.com'=> 'whois.centralnic.net',
		'kr.com' => 'whois.centralnic.net',
		'gb.com' => 'whois.centralnic.net',
		'no.com' => 'whois.centralnic.net',
		'qc.com' => 'whois.centralnic.net',
		'ru.com' => 'whois.centralnic.net',
		'sa.com' => 'whois.centralnic.net',
		'se.com' => 'whois.centralnic.net',
		'za.com' => 'whois.centralnic.net',
		'uk.com' => 'whois.centralnic.net',
		'us.com' => 'whois.centralnic.net',
		'uy.com' => 'whois.centralnic.net',
		'gb.net' => 'whois.centralnic.net',
		'se.net' => 'whois.centralnic.net',
		'uk.net' => 'whois.centralnic.net',
		'za.net' => 'whois.za.net',
		'za.org' => 'whois.za.net',
		'co.za'  => 'http://co.za/cgi-bin/whois.sh?Domain={domain}.co.za',
		'org.za' => 'http://www.org.za/cgi-bin/rwhois?domain={domain}.org.za&format=full'
	];

/* handled gTLD whois servers */

    protected $WHOIS_GTLD_HANDLER = array(
		'whois.bulkregister.com'			=> 'enom',
		'whois.dotregistrar.com'			=> 'dotster',
		'whois.namesdirect.com'				=> 'dotster',
		'whois.psi-usa.info'				=> 'psiusa',
		'whois.www.tv'						=> 'tvcorp',
		'whois.tucows.com'					=> 'opensrs',
		'whois.35.com'						=> 'onlinenic',
		'whois.nominalia.com'				=> 'genericb',
		'whois.encirca.com'					=> 'genericb',
		'whois.corenic.net'					=> 'genericb'
	);

/* Non ICANN TLD's */

	protected $non_ican = array (
			'agent'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'agente'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'america'	=> 'http://www.adns.net/whois.php?txtDOMAIN={domain}.{tld}',
			'amor'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'amore'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'amour'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'arte'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'artes'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'arts'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'asta'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'auction'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'auktion'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'boutique'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'chat'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'chiesa'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'church'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'cia'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'ciao'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'cie'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'club'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'clube'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'com2'		=> 'http://www.adns.net/whois.php?txtDOMAIN={domain}.{tld}',
			'deporte'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'ditta'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'earth'		=> 'http://www.adns.net/whois.php?txtDOMAIN={domain}.{tld}',
			'eglise'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'enchere'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'escola'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'escuela'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'esporte'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'etc'		=> 'http://www.adns.net/whois.php?txtDOMAIN={domain}.{tld}',
			'famiglia'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'familia'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'familie'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'family'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'free'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'hola'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'game'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'ges'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'gmbh'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'golf'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'gratis'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'gratuit'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'iglesia'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'igreja'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'inc'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'jeu'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'jogo'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'juego'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'kids'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'kirche'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'krunst'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'law'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'legge'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'lei'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'leilao'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'ley'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'liebe'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'lion'		=> 'http://www.adns.net/whois.php?txtDOMAIN={domain}.{tld}',
			'llc'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'llp'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'loi'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'loja'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'love'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'ltd'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'makler'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'med'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'mp3'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'not'		=> 'http://www.adns.net/whois.php?txtDOMAIN={domain}.{tld}',
			'online'	=> 'http://www.adns.net/whois.php?txtDOMAIN={domain}.{tld}',
			'recht'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'reise'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'resto'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'school'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'schule'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'scifi'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'scuola'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'shop'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'soc'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'spiel'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'sport'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'subasta'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'tec'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'tech'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'tienda'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'travel'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'turismo'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'usa' 		=> 'http://www.adns.net/whois.php?txtDOMAIN={domain}.{tld}',
			'verein'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'viaje'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'viagem'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'video'		=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'voyage'	=> 'http://www.new.net/search_whois.tp?domain={domain}&tld={tld}',
			'z'			=> 'http://www.adns.net/whois.php?txtDOMAIN={domain}.{tld}'
    	);

		public function __construct($domain) {
			$domain = strtolower(trim($domain));
		    $domain = preg_replace('/^http:\/\//i', '', $domain);
		    $domain = preg_replace('/^https:\/\//i', '', $domain);
		    $domain = preg_replace('/^www\./i', '', $domain);
		    $domain = explode('/', $domain);
		    $this->domain = trim($domain[0]);

		    $_domain = explode('.', $this->domain);
		    $lst = count($_domain)-1;
		    $this->ext = $_domain[$lst];
		    $this->getDetails();
		}

		public function getDomainName() {
			return $this->domain;
		}

    	protected function getDetails() {
		    $nic_server = $this->whois_servers[$this->ext];
    		if ($conn = fsockopen ($nic_server, 43)) {
	        	fputs($conn, $this->domain."\r\n");
		        while(!feof($conn)) {
		            $this->output[] = fgets($conn,128);
		        }
	        	fclose($conn);
    		}

    		return $this->output;
    	}

    	private function parseContent($string) {
    		$content = [];
    		foreach($this->output as $output) {
    			$pos = strpos($output, $string);
    			if($pos !== false) {
    				$content[] = (str_replace([$string, '\r\n', '\n'], '', $output));
    			}
    		}
    		return $content;
    	}

    	public function getRegistrar() {
    		$registrar = $this->parseContent('Registrar:');
    		return count($registrar) ? trim($registrar[0]) : false;
    	}

    	public function getDomainStatus() {
    		$status = $this->parseContent('Registrar:');
    		return (bool) count($status);
    	}

    	public function showDetails() {
    		return $this->statuses;
    	}

    	public function aRecords() {
    		$records = dns_get_record($this->domain);
    		$a_records = array_filter($records, function($arr){
            	return $arr['type'] == 'A';
        	});

        	return count($a_records) ? $a_records[0]['ip'] : false;
    	}

  //   	protected $servers = [
  //   	'ac'=> 'whois.nic.ac',
		// 'ad'=> 'whois.ripe.net'
		// 'ae'=> 'whois.aeda.net.ae'
		// 'aero'=> 'whois.aero'
		// 'af'=> 'whois.nic.af'
		// 'ag'=> whois.nic.ag
		// 'ai'=> whois.ai
		// 'al'=> whois.ripe.net
		// 'am'=> whois.amnic.net
		// 'as'=> whois.nic.as
		// 'asia'=> whois.nic.asia
		// 'at'=> whois.nic.at
		// 'au'=> whois.aunic.net
		// 'aw'=> whois.nic.aw
		// 'ax'=> whois.ax 
		// 'az'=> whois.ripe.net

		// 'ca'=> whois.cira.ca
		// 'cat'=> whois.cat
		// 'cc'=> whois.nic.cc
		// 'cd'=> whois.nic.cd
		// 'ceo'=> whois.nic.ceo
		// 'cf'=> whois.dot.cf
		// 'ch'=> whois.nic.ch 
		// 'ci'=> whois.nic.ci
		// 'ck'=> whois.nic.ck
		// 'cl'=> whois.nic.cl
		// 'cloud'=> 'whois.nic.cloud'
		// 'club'=> 'whois.nic.club'
		// 'cn'=> 'whois.cnnic.net.cn'
		// 'cn.com'=> 'whois.centralnic.com'
		// 'co'=> 'whois.nic.co'
		// 'co.nl'=> 'whois.co.nl'
		// 'com' 'whois.verisign-grs.com'
		// 'coop' 'whois.nic.coop'
		// 'cx' 'whois.nic.cx'
		// 'cy' 'whois.ripe.net'
		// 'cz' 'whois.nic.cz'
		// 'de' 'whois.denic.de'
		// 'dk' 'whois.dk-hostmaster.dk'
		// 'dm' 'whois.nic.cx'
		// 'dz'=>'whois.nic.dz'
		// 'ec'=> 'whois.nic.ec'
		// 'edu'=> 'whois.educause.net'
		// ee whois.tld.ee
		// eg whois.ripe.net
		// es whois.nic.es
		// eu whois.eu
		// eu.com whois.centralnic.com
		// eus whois.nic.eus
		// fi whois.fi
		// fo whois.nic.fo
		// fr whois.nic.fr
		// gb whois.ripe.net
		// gb.com whois.centralnic.com
		// gb.net whois.centralnic.com
		// qc.com whois.centralnic.com
		// ge whois.ripe.net
		// gg whois.gg
		// gi whois2.afilias-grs.net
		// gl whois.nic.gl
		// gm whois.ripe.net
		// gov whois.nic.gov
		// gr whois.ripe.net
		// gs whois.nic.gs
		// gy whois.registry.gy
		// hamburg whois.nic.hamburg
		// hiphop whois.uniregistry.net
		// hk whois.hknic.net.hk
		// hm whois.registry.hm
		// hn whois2.afilias-grs.net
		// host whois.nic.host
		// hr whois.dns.hr
		// ht whois.nic.ht
		// hu whois.nic.hu
		// hu.com whois.centralnic.com
		// id whois.pandi.or.id
		// ie whois.domainregistry.ie
		// il whois.isoc.org.il
		// im whois.nic.im
		// in whois.inregistry.net
		// info whois.afilias.info
		// ing domain-registry-whois.l.google.com
		// ink whois.centralnic.com
		// int whois.isi.edu
		// io whois.nic.io
		// iq whois.cmc.iq
		// ir whois.nic.ir
		// is whois.isnic.is
		// it whois.nic.it
		// je whois.je
		// jobs jobswhois.verisign-grs.com
		// jp whois.jprs.jp
		// ke whois.kenic.or.ke
		// kg whois.domain.kg
		// ki whois.nic.ki
		// kr whois.kr
		// kz whois.nic.kz
		// la whois2.afilias-grs.net
		// li whois.nic.li
		// london whois.nic.london
		// lt whois.domreg.lt
		// lu whois.restena.lu
		// lv whois.nic.lv
		// ly whois.lydomains.com
		// ma whois.iam.net.ma
		// mc whois.ripe.net
		// md whois.nic.md
		// me whois.nic.me
		// mg whois.nic.mg
		// mil whois.nic.mil
		// mk whois.ripe.net
		// ml whois.dot.ml
		// mo whois.monic.mo
		// mobi whois.dotmobiregistry.net
		// ms whois.nic.ms
		// mt whois.ripe.net
		// mu whois.nic.mu
		// museum whois.museum
		// mx whois.nic.mx
		// my whois.mynic.net.my
		// mz whois.nic.mz
		// na whois.na-nic.com.na
		// name whois.nic.name
		// nc whois.nc
		// net whois.verisign-grs.com
		// nf whois.nic.cx
		// ng whois.nic.net.ng
		// nl whois.domain-registry.nl
		// no whois.norid.no
		// no.com whois.centralnic.com
		// nu whois.nic.nu
		// nz whois.srs.net.nz
		// om whois.registry.om
		// ong whois.publicinterestregistry.net
		// ooo whois.nic.ooo
		// org whois.pir.org
		// paris whois-paris.nic.fr
		// pe kero.yachay.pe
		// pf whois.registry.pf
		// pics whois.uniregistry.net
		// pl whois.dns.pl
		// pm whois.nic.pm
		// pr whois.nic.pr
		// press whois.nic.press
		// pro whois.registrypro.pro
		// pt whois.dns.pt
		// pub whois.unitedtld.com
		// pw whois.nic.pw
		// qa whois.registry.qa
		// re whois.nic.re
		// ro whois.rotld.ro
		// rs whois.rnids.rs
		// ru whois.tcinet.ru
		// sa saudinic.net.sa
		// sa.com whois.centralnic.com
		// sb whois.nic.net.sb
		// sc whois2.afilias-grs.net
		// se whois.nic-se.se
		// se.com whois.centralnic.com
		// se.net whois.centralnic.com
		// sg whois.nic.net.sg
		// sh whois.nic.sh
		// si whois.arnes.si
		// sk whois.sk-nic.sk
		// sm whois.nic.sm
		// st whois.nic.st
		// so whois.nic.so
		// su whois.tcinet.ru
		// sx whois.sx
		// sy whois.tld.sy
		// tc whois.adamsnames.tc
		// tel whois.nic.tel
		// tf whois.nic.tf
		// th whois.thnic.net
		// tj whois.nic.tj
		// tk whois.nic.tk
		// tl whois.domains.tl
		// tm whois.nic.tm
		// tn whois.ati.tn
		// to whois.tonic.to
		// top whois.nic.top
		// tp whois.domains.tl
		// tr whois.nic.tr
		// travel whois.nic.travel
		// tw whois.twnic.net.tw
		// tv whois.nic.tv
		// tz whois.tznic.or.tz
		// ua whois.ua
		// ug whois.co.ug
		// uk whois.nic.uk
		// uk.com whois.centralnic.com
		// uk.net whois.centralnic.com
		// ac.uk whois.ja.net
		// gov.uk whois.ja.net
		// us whois.nic.us
		// us.com whois.centralnic.com
		// uy nic.uy
		// uy.com whois.centralnic.com
		// uz whois.cctld.uz
		// va whois.ripe.net
		// vc whois2.afilias-grs.net
		// ve whois.nic.ve
		// vg ccwhois.ksregistry.net
		// vu vunic.vu
		// wang whois.nic.wang
		// wf whois.nic.wf
		// wiki whois.nic.wiki
		// ws whois.website.ws
		// xxx whois.nic.xxx
		// xyz whois.nic.xyz
		// yu whois.ripe.net
		// za.com whois.centralnic.com
  //   ];
}
