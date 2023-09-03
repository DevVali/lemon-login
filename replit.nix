{ pkgs }: {
	deps = [
  		pkgs.yarn
    pkgs.php81
		pkgs.php81Packages.composer    
	];
}