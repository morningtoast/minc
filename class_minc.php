<?php
/*
    MINC Mini Content Management
	2012, Brian Vaughn - @morningtoast
*/	
	class minc {
	
		// Constructor, optional pass override settings
		function minc($a_settings=array()) {
			$a_default = array(
				"path"      => "./content/",
				"extension" => ".inc",
				"enablerun" => false
			);
			
			$this->settings = array_merge($a_default, $a_settings);
		}
		
		// Echos raw file requested
		function fetch() {
			if (isset($_GET["fetch"])) {
				echo $this->get($_GET["fetch"], false);
			} else {
				return(false);
			}
		}
		
		// Echos trimmed content file; This is used in content pages
		function load($id) {
			echo $this->get($id);
		}
		
		// Reads content file with optional trim
		function get($id, $trim=true) {
			$output = "";
			$path   = $this->getPath($id);
			
			if (file_exists($path)) {
				$lines   = file($path);
				if ($trim) { $summary = array_shift($lines); }
						
				$output = implode("",$lines);
			}
			
			return($output);
		}
		
		// Evals content block; Must enable eval in settings
		function run($id) {
			if ($this->enablerun) {
				$code = $this->get($id);
				eval($code);
			}
		}
		
		// Builds server path to content file
		function getPath($id) {
			$path = $this->settings["path"].$id.$this->settings["extension"];
			return($path);
		}
		
		// Reads content directory for listing
		function dir() {
			$a_list = array();
			if ($handle = opendir($this->settings["path"])) {
				while (false !== ($entry = readdir($handle))) {
					if ($entry != "." && $entry != "..") {
						$lines   = file($this->settings["path"].$entry);
						$summary = array_shift($lines);
						
						$a_list[] = array(
							"file"    => $entry,
							"id"      => str_replace(".inc","",$entry),
							"summary" => $summary
						);
					}
				}
				closedir($handle);
			}
			
			$this->list = $a_list;
		}
		
		// Saves changes to content file
		function save() {
			if (isset($_POST["save"])) {
				$summary = $_POST["contentsummary"];
				$code    = $_POST["content"];
				$id      = str_replace(" ","-",strtolower(trim(strip_tags($_POST["contentid"]))));
				$path    = $this->getPath($id);
				
				$content = $summary."\r\n".$code;
			
				$fr = fopen($path,"w+");
				fwrite($fr,$content);
				fclose($fr);
				
				return($path);
			}
		}
		
		// Deletes content file
		function delete() {
			$success = false;
			
			if (isset($_GET["k"])) {
				$success = unlink($this->getPath($_GET["k"]));
			}
			
			return($success);
		}
	}
?>