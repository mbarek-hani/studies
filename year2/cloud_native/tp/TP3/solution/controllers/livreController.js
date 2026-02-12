import Livre from "../models/Livre.js";

export async function getAllLivre(req, res) {
    try {
        const livres = await Livre.find();
        res.status(200).json(livres);
    } catch (error) {
        res.status(400).json({ data: error.message });
    }
}

export async function getLivreById(req, res) {
    try {
        const livre = await Livre.findById(req.params.id);
        if (!livre) {
            res.status(404).json({message: "livre not found"});
        }
        res.status(200).json(livre);
    } catch (error) {
        res.status(400).json({ message: error.message });
    }
}

export async function addLivre(req, res) {
    try {
        const livre = await Livre.create(req.body);
        if (!livre) {
            json.status(500).json({ message: 'something went wrong' });
        }
        res.status(201).json(livre);
    } catch (error) {
        if (error.name == 'ValidationError') {
            res.status(400).json({ message: error.message });
        }
        res.status(500).json({ data: error.message });
    }
}

export async function removeLivre(req, res) {
    try {
        const livre = await Livre.findByIdAndDelete(req.params.id);
        if (!livre) {
            res.status(404).json({ message: 'livre not found!' });
        }
        res.status(201).json(livre);
    } catch (error) {
        res.status(500).json({ message: error.message });
    }
}

export async function updateLivre(req, res) {
    try {
        const livre = await Livre.findByIdAndUpdate(
            req.params.id,
            req.body,
            {
                new: true,
                runValidators: true
            }
        );
        if (!livre) {
            return res.status(404).json({ message: 'livre not found!' });
        }
        res.status(201).json(livre);
    } catch (error) {
        if (error.name = "ValidationError") {
            res.status(400).json({ message: error.message });
        }
        res.status(500).json({ message: error.message });
    }
}

export async function getLivresByGenre(req, res) {
    try {
        let livres;
        const genre = req.query.gener || null;
        if (genre) {
            livres = await Livre.find({ genre });
        } else {
            livres = await Livre.find();
        }
        res.status(200).json(livres);
    } catch (error) {
        res.status(400).json({ message: error.message });
    }
}

export async function getLivresDisponibles(req, res) {
    try {
        const livres = await Livre.find({ disponible: true });
        res.status(200).json(livres);
    } catch (error) {
        return res.status(400).json({ message: error.message });
    }
}

export async function deleteAll(req, res) {
    try {
        const livres = await Livre.deleteMany({});
        res.status(201).json(livres);
    } catch (error) {
        res.status(500).json({ message: error.message });
    }
}
