import express from 'express';
import { 
    getAllLivre,
    getLivresDisponibles, 
    getLivresByGenre,
    getLivreById,
    addLivre,
    deleteAll,
    removeLivre,
    updateLivre
} from '../controllers/livreController.js';

const router = express.Router();

router.get('/', getAllLivre);

router.get('/gener', getLivresByGenre);

router.get('/disponibles', getLivresDisponibles);

router.get('/:id', getLivreById);

router.post('/', addLivre);

router.delete('/', deleteAll);

router.delete('/:id', removeLivre);

router.put('/:id', updateLivre);

export default router;