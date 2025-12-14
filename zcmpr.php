if ($this->image) {
            // TRUQUE 1: Limpar o caminho 🧹
            // Se a imagem na BD já vier com "posts/", nós tiramos para não duplicar
            $imageName = str_replace('posts/', '', $this->image);

            // TRUQUE 2: Verificar na pasta nova (storage/app/public/posts)
            if (Storage::disk('public')->exists('posts/' . $imageName)) {
                return asset('storage/posts/' . $imageName);
            }

            // (Opcional) Debug: Descomenta isto se quiseres ver no ecrã o que ele está a procurar
            // dd("Estou à procura de: public/posts/" . $imageName);
        }

        // Se falhar tudo, mostra a default
        ret



return FileController::get('posts', $this->id_post);