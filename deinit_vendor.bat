@echo off
setlocal enabledelayedexpansion

:: Establece la ruta del proyecto
set "PROJECT_DIR=C:\GitProjects\Attendify"

:: Recorre todas las carpetas .git y .github dentro de vendor/
for /r "%PROJECT_DIR%\vendor" %%d in (.git .github) do (
    if exist "%%d" (
        echo Eliminando: %%d
        rd /s /q "%%d"
    )
)

echo Las carpetas .git y .github han sido eliminadas de vendor.
pause