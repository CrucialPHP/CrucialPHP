#!/bin/bash
echo "[CrucialPHP] Starting installation..."
echo "[CrucialPHP] Downloading library - this may take a while on slower networks."
curl https://raw.githubusercontent.com/CrucialPHP/CrucialPHP/main/lib/crucial.php >> CrucialPHP.lib.php > /dev/null
echo "[CrucialPHP] Libarary downloaded. Downloading additional required scripts..."
curl https://raw.githubusercontent.com/CrucialPHP/CrucialPHP/main/README.md >> CrucialPHP.README.md > /dev/null
echo "[CrucialPHP] Additional required scripts downloaded."
echo "[CrucialPHP] Installation complete."
echo "[CrucialPHP] To use CrucialPHP, please include the following at the top of each PHP script:"
echo "[CrucialPHP] <?php"
echo "[CrucialPHP] ###############################"
echo "[CrucialPHP] #                             #"
echo "[CrucialPHP] #      CrucialPHP Script      #"
echo "[CrucialPHP] # include 'CrucialPHP.lib.php #"
echo "[CrucialPHP] #                             #"
echo "[CrucialPHP] ###############################
