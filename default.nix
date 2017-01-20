let
  version = "0.0.1";
  pkgs = import <nixpkgs> {};
  stdenv = pkgs.stdenv;
in stdenv.mkDerivation rec {
   name = "composer2nix-${version}";
   buildInputs = [pkgs.php70 pkgs.php70Packages.composer]; 
}
